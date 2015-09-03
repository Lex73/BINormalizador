<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public $BIconfiguracion;
	public $BIError;
	public $m_Archivo;
	public $m_Salida;

	public function __construct()
	{
		parent:: __construct();
		$this->BIconfiguracion = $this->biconfig->getConfig();
		$this->BIerror = '';
		$this->m_Archivo = '';
		$this->m_Salida = '';
		$this->load->model('tablas_model');
		$this->load->model('log_model');
	}

	public function index()
	{
		if($this->BIconfiguracion == true)
		{
			$mensaje['titulo']= 'Principal';
			$this->load->view('Plantillas/Header',$mensaje);
			$this->load->view('Pruebas/Index');
			$this->load->view('Plantillas/Footer');
	  }
		else
		{
			echo 'Error al cargar la configuración';
		}
	}

	public function procesar()
	{
		$arch = $this->input->post('Archivo');
		$tipo = $this->input->post('Tipo');
		$salida = $this->input->post('TipoS');
		$SeparadorE = $this->input->post('SeparadorE');
		if($arch != '')
		{
			if(file_exists($this->config->item('FOLUP').$arch))
			{
				$query = $this->tablas_model->get_tabla('Prueba',1);
				foreach ($query as  $row)
				{
					$tabla = $row->IDTabla;
				}

				$query = $this->tablas_model->get_campos($tabla);
				$nombreCampo = array();
				$tipoCampo = array();
				$cantidadDeCampos = 0;
				$arrExcelEncab = array();
				$arrExcelVal = array();
				$archivo = rand();
				$soloNombre = explode('.',$arch);
				$numeroLinea=-1;
				$encabezado = true;

				foreach ($query as $row)
				{
					array_push($nombreCampo, $row->NOMCampo);
					array_push($tipoCampo, $row->TYPCampo);
					$cantidadDeCampos++;
				}

				if($tipo == 'txt')
				{
					$file_i = fopen($this->config->item('FOLUP').$arch, "r");
					while(!feof($file_i))
					{
						$linea = fgets($file_i);
						if($linea != '')
						{
							$numeroLinea++;
							$campo = explode ($SeparadorE,$linea);
							$i=0;
							foreach($campo as $valor)
							{
								if($numeroLinea > 0)
								{
										if($tipoCampo[$i] == 'Fecha')
										{
											 try
											 {
											    $fecha = new DateTime($valor);
													$valor = $fecha->format($this->config->item('DATFO'));
												}
												catch (Exception $e)
												{
													try
													{
														$valor = str_replace('/','-',$valor);
											    	$fecha = new DateTime($valor);
														$valor = $fecha->format($this->config->item('DATFO'));
													}
													catch (Exception $e)
													{
														$this->BIerror = 'Error al convertir fecha: '.$valor.' campo: '.$nombreCampo[$i].' en la linea: '.$numeroLinea;
														$this->load->library('bilog');
														$this->bilog->escribeLog($this->BIerror,$soloNombre[0]);
														return false;
													}
												}
										}
										elseif ($tipoCampo[$i] == 'Cadena')
										{
											$valor = $valor;
										}
										elseif ($tipoCampo[$i] == 'Entero')
										{
											$pos = strpos($valor, ',');
											if($pos !== false)
											{
												$entero = explode ( ',' , $valor);
												$valor = $entero[0];
											}
											else
											{
												$pos = strpos($valor, '.');
												if($pos !== false)
												{
													$entero = explode ( '.' , $valor);
													$valor = $entero[0];
												}
											}

											if(!is_numeric($valor))
											{
													$this->BIerror = 'Error al convertir el numero: '.$valor.' campo: '.$nombreCampo[$i].' en la linea: '.$numeroLinea;
													$this->load->library('bilog');
													$this->bilog->escribeLog($this->BIerror,$soloNombre[0]);
													return false;
											}
										}
										elseif ($tipoCampo[$i] == 'Flotante')
										{
												$esNumero = true;
											  $cambiadoACero = false;
												$valor = str_replace(',','.',$valor);
												$componentes = explode ( '.' , $valor);

												if($componentes[0] == '')
												{
													$componentes[0] = '0';
													$cambiadoACero = true;
												}

												try
												{
													$entero = (float)$componentes[0];
													if($entero == 0)
													{
														if($cambiadoACero == false)
														{
															$esNumero = false;
														}
													}
											  }
												catch(Exception $e)
												{
													$this->BIerror = 'Error al convertir el numero: '.$valor.' campo: '.$nombreCampo[$i].' en la linea: '.$numeroLinea;
													$this->load->library('bilog');
													$this->bilog->escribeLog($this->BIerror,$soloNombre[0]);
													return false;
												}

												if(count($componentes) > 1)
												{
														try
														{
															if($componentes[1] != '0')
															{
																$decimal = (float)$componentes[1];
																if($decimal == 0)
																{
																		$esNumero = false;
																}
															}
													  }
														catch(Exception $e)
														{
															$this->BIerror= 'Error al convertir el numero: '.$valor.' campo: '.$nombreCampo[$i].' en la linea: '.$numeroLinea;
															$this->load->library('bilog');
															$this->bilog->escribeLog($this->BIerror,$soloNombre[0]);
															return false;
														}
											  }
												if($esNumero == true)
												{
													$valor = (float)$valor;
												}
												else
												{
													$this->BIerror = 'Error al convertir el numero: '.$valor.' campo: '.$nombreCampo[$i].' en la linea: '.$numeroLinea;
													$this->load->library('bilog');
													$this->bilog->escribeLog($this->BIerror,$soloNombre[0]);
													return false;
												}
										}

										if($salida != 'xlsx')
										{
												$file_o = fopen($this->config->item('FOLPR').'archivo_'.$archivo.'.'.$salida, "a");

												if($i == $cantidadDeCampos-1)
												{
															if(trim($valor) != '')
															{
																	fwrite($file_o,$valor);
																	fwrite($file_o,PHP_EOL);
														  }
												}
												else
												{
													if(trim($valor) != '')
													{
															fwrite($file_o,$valor.$this->config->item('DATSE'));
													}
												}
												fclose($file_o);
												$i++;
									  }
										else
										{
												array_push($arrExcelVal,$valor);
												$i++;
										}
								}
								else
								{
									if($salida != 'xlsx')
									{
											$file_o = fopen($this->config->item('FOLPR').'archivo_'.$archivo.'.'.$salida, "a");
											if($i == $cantidadDeCampos-1)
											{
													if(trim($valor) != '')
													{
															fwrite($file_o,$valor);
															//fwrite($file_o,PHP_EOL);
												  }
											}
											else
											{
												if(trim($valor) != '')
												{
														fwrite($file_o,$valor.$this->config->item('DATSE'));
											  }
											}
											fclose($file_o);
											$i++;
								  }
									else
									{
											array_push($arrExcelEncab,$valor);
											$i++;
									}
								}
							}
						}
					}
					if($salida == 'xlsx')
					{
							$file_o = $this->config->item('FOLPR').'archivo_'.$archivo;
							$this->escribeExcel($file_o,$arrExcelEncab,$arrExcelVal,$cantidadDeCampos);
					}
					fclose($file_i);
				}
				else
				{
						$encab = 0;
						$no = false;
						$this->load->library('excel');
						$objReader = PHPExcel_IOFactory::createReader('Excel2007');
						$objReader->setReadDataOnly(true);

						$objPHPExcel = $objReader->load($this->config->item('FOLUP').$arch);
						$objWorksheet = $objPHPExcel->getActiveSheet();

								foreach ($objWorksheet->getRowIterator() as $row)
								{
										$cellIterator = $row->getCellIterator();
										$cellIterator->setIterateOnlyExistingCells(false);
										$numeroLinea++;
										$i=0;
										$j=1;
											foreach ($cellIterator as $cell)
											{
												if($numeroLinea > 0)
												{
														$valor = $cell->getValue();
														if($valor != 0)
														{
																if($tipoCampo[$i] == 'Fecha')
																{
																		try
					 											 		{
																				$UNIX_DATE = ($valor - 25569) * 86400;
																				$valor = gmdate($this->config->item('DATFO'), $UNIX_DATE);
					 													}
																		catch (Exception $e)
																		{
					 														try
					 														{
					 															$valor = str_replace('/','-',$valor);
					 											    		$fecha = new DateTime($valor);
					 															$valor = $fecha->format($this->config->item('DATFO'));
					 														}
					 														catch (Exception $e)
					 														{
						 														$this->BIerror = 'Error al convertir fecha: '.$valor.' campo: '.$nombreCampo[$i].' en la linea: '.$numeroLinea;
						 														$this->load->library('bilog');
						 														$this->bilog->escribeLog($this->BIerror,$soloNombre[0]);
																				$no = true;
						 														return false;
					 														}
					 													}
																}
																elseif($tipoCampo[$i] == 'Entero')
																{
																	$pos = strpos($valor, ',');
																	if($pos !== false)
																	{
																		$entero = explode ( ',' , $valor);
																		$valor = $entero[0];
																	}
																	else
																	{
																		$pos = strpos($valor, '.');
																		if($pos !== false)
																		{
																			$entero = explode ( '.' , $valor);
																			$valor = $entero[0];
																		}
																	}

																	if(!is_numeric($valor))
																	{
																			$this->BIerror = 'Error al convertir el numero: '.$valor.' campo: '.$nombreCampo[$i].' en la linea: '.$numeroLinea;
																			$this->load->library('bilog');
																			$this->bilog->escribeLog($this->BIerror,$soloNombre[0]);
																			$no = true;
																			return false;
																	}
																}
																elseif($tipoCampo[$i] == 'Flotante')
																{
																	$esNumero = true;
																  $cambiadoACero = false;
																	$valor = str_replace(',','.',$valor);
																	$componentes = explode ( '.' , $valor);

																	if($componentes[0] == '')
																	{
																		$componentes[0] = '0';
																		$cambiadoACero = true;
																	}

																	try
																	{
																		$entero = (float)$componentes[0];
																		if($entero == 0)
																		{
																			if($cambiadoACero == false)
																			{
																				$esNumero = false;
																			}
																		}
																  }
																	catch(Exception $e)
																	{
																		$this->BIerror = 'Error al convertir el numero: '.$valor.' campo: '.$nombreCampo[$i].' en la linea: '.$numeroLinea;
																		$this->load->library('bilog');
																		$this->bilog->escribeLog($this->BIerror,$soloNombre[0]);
																		$no = true;
																		return false;
																	}

																	if(count($componentes) > 1)
																	{
																			try
																			{
																				if($componentes[1] != '0')
																				{
																					$decimal = (float)$componentes[1];
																					if($decimal == 0)
																					{
																							$esNumero = false;
																					}
																				}
																		  }
																			catch(Exception $e)
																			{
																				$this->BIerror= 'Error al convertir el numero: '.$valor.' campo: '.$nombreCampo[$i].' en la linea: '.$numeroLinea;
																				$this->load->library('bilog');
																				$this->bilog->escribeLog($this->BIerror,$soloNombre[0]);
																				$no = true;
																				return false;
																			}
																  }
																	if($esNumero == true)
																	{
																		$valor = (float)$valor;
																	}
																	else
																	{
																		$this->BIerror = 'Error al convertir el numero: '.$valor.' campo: '.$nombreCampo[$i].' en la linea: '.$numeroLinea;
																		$this->load->library('bilog');
																		$this->bilog->escribeLog($this->BIerror,$soloNombre[0]);
																		$no = true;
																		return false;
																	}
																}
														}
														else
														{
															if($tipoCampo[$i] == 'Cadena')
															{
															}
														}
														$encab = 1;
												}
												else
												{
														$valor = $cell->getValue();
														$encab = 0;
												}

												if($salida != 'xlsx')
												{
														$file_o = fopen($this->config->item('FOLPR').'archivo_'.$archivo.'.'.$salida, "a");

														if($j == $cantidadDeCampos)
														{
															if($no == false)
															{
																if($valor != '')
																{
																	fwrite($file_o,$valor);
																	fwrite($file_o,PHP_EOL);
																}
														  }
															else
															{
																fclose($file_o);
															}
														}
														else
														{
															if($no == false)
															{
																if(trim($valor) != '')
																{
																	fwrite($file_o,$valor.$this->config->item('DATSE'));
															  }
															}
															else
															{
																fclose($file_o);
															}
														}

													$i++;
													$j++;
													fclose($file_o);
												}
												else
												{
													if($encab == 0)
													{
														array_push($arrExcelEncab,$valor);
													}
													else
													{
														array_push($arrExcelVal,$valor);
													}
													$i++;
													$j++;
												}
										}
										if($salida == 'xlsx')
										{
												$file_o = $this->config->item('FOLPR').'archivo_'.$archivo;
												$this->escribeExcel($file_o,$arrExcelEncab,$arrExcelVal,$cantidadDeCampos);
										}
								}
				}

				$ok = $this->do_dataBase_log('archivo_'.$archivo.'.'.$salida,$arch,'Prueba',1,$this->config->item('FOLPR'));
				$this->m_Archivo = 'archivo_'.$archivo.'.'.$salida;
				$this->m_Salida = $salida;

				//return $ok;
			}
			else
			{
				$this->BIerror = 'Archivo: '.$arch.' no encontrado';
				return false;
			}
		}
		else
		{
			$this->BIerror = 'El campo no puede estar vacio';
			return false;
		}

						$mensaje['archivo'] = $this->m_Archivo;
						$mensaje['salida'] = $this->m_Salida;
						$mensaje['descargar'] = true;
						$mensaje['titulo']= 'Principal';
						$mensaje['mens']= 'Proceso finalizado correctamente';
						$this->load->view('Plantillas/Header',$mensaje);
						$this->load->view('Pruebas/Success');
						$this->load->view('Plantillas/Footer');

	}

	public function do_download($archivo,$salida)
	{
		try
		{
				$datos = file_get_contents($this->config->item('FOLPR').$archivo);
				$nombre = $this->config->item('NARCH').'o.'.$salida;
				force_download($nombre, $datos);
				return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	public function do_dataBase_log($archivo,$orig,$usuario,$cuenta,$ruta)
	{
		try
		{
				$data = array('archivo' => $archivo,
											'NOMOriginal' => $orig,
										  'IDUsuario' => $usuario,
										  'IDCuenta' => $cuenta,
										  'Ubicacion' => $ruta);

				$this->log_model->insert_log($data);
				return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	public function escribeExcel($archivo,$arrExcelEncab,$arrExcelVal,$cantidadDeCampos)
	{
				$this->load->library('excel');

				$i = 0;
				$column = 0;
				$row = 1;

				$objPHPExcel = new PHPExcel();
				// Set properties
				$objPHPExcel->getProperties()->setCreator("BINormalizador")
										->setLastModifiedBy("Prueba")
										->setTitle("BINormalizador Document")
										->setSubject("BINormalizador Document")
										->setDescription("BINormalizador, generated by PHPExcel.");

				$objPHPExcel->getActiveSheet()->setTitle('Datos');

				foreach($arrExcelEncab as $campo)
				{
						$objPHPExcel->setActiveSheetIndex(0)
												->setCellValueByColumnAndRow($column, $row, $campo);
						$column++;
				}

				$row++;
				$column = 0;
				foreach($arrExcelVal as $campo)
				{
					if($i == $cantidadDeCampos)
					{
						$i = 0;
						$row++;
						$column = 0;
					}
						$objPHPExcel->setActiveSheetIndex(0)
												->setCellValueByColumnAndRow($column, $row, $campo);
						$column++;
						$i++;
				}

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				//Si queremos crear un PDF
				//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
				$objWriter->save($archivo.'.xlsx');
	}

	public function Upload()
	{
		$ruta = $this->config->item('FOLUP');
		$mensaje = 'nada';

		foreach ($_FILES as $key)
		{
				if ($key['error'] == UPLOAD_ERR_OK)
				{
					$NombreOriginal = $key['name'];
					$temporal = $key['tmp_name'];
					$Destino = $ruta.$NombreOriginal;

					move_uploaded_file($temporal,$Destino);
				}

				if ($key['error'] == '')
				{
					$mensaje = $NombreOriginal;
				}

				if ($key['error'] != '')
				{
					$mensaje = 'KO';
				}
		}

		echo $mensaje;
	}
}

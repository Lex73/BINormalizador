<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index()
	{
		$this->load->view('Pruebas/Index');
	}

	public function procesar()
	{
		$arch = trim($this->input->post('archivo'));
		if($arch != '')
		{
			if(file_exists('./assets/documents/'.$this->input->post('archivo')))
			{
				$file_i = fopen('./assets/documents/'.$this->input->post('archivo'), "r");
				$nombreCampo = array('Campo1','Campo2','Campo3','Campo4');
				$cantidadDeCampos = 3;
				$tipoCampo = array('Fecha','Cadena','Entero','Flotante');
				$numeroLinea=-1;
				$encabezado = true;
				$archivo = rand();

				while(!feof($file_i))
				{
					$linea = fgets($file_i);
					if($linea != '')
					{
						$numeroLinea++;
						$campo = explode ( '|' , $linea);
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
												$valor = $fecha->format('Y-m-d');
											} catch (Exception $e) {
												try
												{
													$valor = str_replace('/','-',$valor);
										    	$fecha = new DateTime($valor);
													$valor = $fecha->format('Y-m-d');
												}
												catch (Exception $e)
												{
													$mensaje['error'] = 'Error al convertir fecha: '.$valor.' campo: '.$nombreCampo[$i].' en la linea: '.$numeroLinea;
													echo $mensaje['error'];
													$this->load->view('errors/errores',$mensaje);
													unlink('./assets/documents/archivo_'.$archivo.'.txt');
													exit();
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
												$mensaje['error'] = 'Error al convertir el numero: '.$valor.' campo: '.$nombreCampo[$i].' en la linea: '.$numeroLinea;
												echo $mensaje['error'];
												$this->load->view('errors/errores',$mensaje);
												unlink('./assets/documents/archivo_'.$archivo.'.txt');
												exit();
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
												$mensaje['error'] = 'Error al convertir el numero: '.$valor.' campo: '.$nombreCampo[$i].' en la linea: '.$numeroLinea;
												echo $mensaje['error'];
												$this->load->view('errors/errores',$mensaje);
												unlink('./assets/documents/archivo_'.$archivo.'.txt');
												exit();
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
														$mensaje['error'] = 'Error al convertir el numero: '.$valor.' campo: '.$nombreCampo[$i].' en la linea: '.$numeroLinea;
														echo $mensaje['error'];
														$this->load->view('errors/errores',$mensaje);
														unlink('./assets/documents/archivo_'.$archivo.'.txt');
														exit();
													}
										  }
											if($esNumero == true)
											{
												$valor = (float)$valor;
											}
											else
											{
												$mensaje['error'] = 'Error al convertir el numero: '.$valor.' campo: '.$nombreCampo[$i].' en la linea: '.$numeroLinea;
												echo $mensaje['error'];
												$this->load->view('errors/errores',$mensaje);
												unlink('./assets/documents/archivo_'.$archivo.'.txt');
												exit();
											}
									}
									$file_o = fopen('./assets/documents/archivo_'.$archivo.'.txt', "a");

									if($i == $cantidadDeCampos)
									{
										fwrite($file_o,$valor);
									}
									else
									{
										fwrite($file_o,$valor.';');
									}
									fclose($file_o);
									$i++;
							}
							else
							{
								$file_o = fopen('./assets/documents/archivo_'.$archivo.'.txt', "a");
								if($i == $cantidadDeCampos)
								{
									fwrite($file_o,$valor);
								}
								else
								{
									fwrite($file_o,$valor.';');
								}
								fclose($file_o);
								$i++;
							}
						}
					}
				}
				fclose($file_i);

				$datos = file_get_contents('./assets/documents/archivo_'.$archivo.'.txt');
				$nombre = 'archivo_o.txt';
				force_download($nombre, $datos);
			}
			else
			{
				$mensaje['error'] = 'Archivo no encontrado';
				echo $mensaje['error'];
				$this->load->view('errors/errores',$mensaje);
				exit();
			}
		}
		else
		{
			echo 'El campo no puede estar vacio';
		}
	}
}

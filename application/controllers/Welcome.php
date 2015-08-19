<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public $BIconfiguracion;
	public $BIError;

	public function __construct()
	{
		parent:: __construct();
		$this->BIconfiguracion = $this->biconfig->getConfig();
		$this->BIerror = '';
		$this->load->model('tablas_model');
	}

	public function index()
	{
		if($this->BIconfiguracion == true)
		{
			$mensaje['ok'] = '';
			$mensaje['upload_data']='';
			$this->load->view('Pruebas/Index',$mensaje);
	  }
		else
		{
			echo 'Error al cargar la configuración';
		}
	}

	public function procesar($arch)
	{
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

				foreach ($query as $row)
				{
					array_push($nombreCampo, $row->NOMCampo);
					array_push($tipoCampo, $row->TYPCampo);
					$cantidadDeCampos++;
				}
				
				$file_i = fopen($this->config->item('FOLUP').$arch, "r");
				$numeroLinea=-1;
				$encabezado = true;
				$archivo = rand();
				$soloNombre = explode('.',$arch);

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
									$file_o = fopen($this->config->item('FOLPR').'archivo_'.$archivo.'.txt', "a");

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
								$file_o = fopen($this->config->item('FOLPR').'archivo_'.$archivo.'.txt', "a");
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

				$datos = file_get_contents($this->config->item('FOLPR').'archivo_'.$archivo.'.txt');
				$nombre = $this->config->item('NARCH').'_o.txt';
				force_download($nombre, $datos);
				rename($this->config->item('FOLPR').'archivo_'.$archivo.'.txt', $this->config->item('FOLDO').'archivo_'.$archivo.'.txt');
				return true;
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
	}

	public function do_upload()
	{
		$config['upload_path'] = $this->config->item('FOLUP');
		$config['allowed_types'] = $this->config->item('ALLTY');
		$config['max_size']	= '1000';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload())
		{
			$mensaje['mens'] = $this->upload->display_errors().' - '.$config['upload_path'];
			$this->load->view('errors/errores',$mensaje);
		}
		else
		{
			$mensaje['upload_data'] = $this->upload->data();
			$mensaje['mens'] = '';
			$mensaje['error'] = '';
			$arch = $this->upload->data('file_name');
			$ok = $this->procesar($arch);

			if($ok == true)
			{
				$mensaje['mens'] = 'Archivo procesado correctamente';
				//$this->load->view('Pruebas/Index', $mensaje);
			}
			else
			{
				$mensaje['error'] = $this->BIerror;
				$this->load->view('errors/errores',$mensaje);
			}
		}
	}
}

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
			$file_i = fopen('C:\\Users\\alopez\\Documents\\'.$this->input->post('archivo'), "r");
			$nombreCampo = array('Campo1','Campo2','Campo3','Campo4');
			$tipoCampo = array('Fecha','Cadena','Entero','Flotante');
			$i=0;
			$linea=-1;
			$encabezado = true;

			while(!feof($file_i))
			{
				$linea++;
				if ($linea > 0)
				{
					$i++;
				}
				$campo = explode ( '|' , fgets($file_i));
				foreach($campo as $valor)
				{
					//echo $encabezado;
					if($linea > 0)
					{
							echo 'tipo campo= '.$tipoCampo[$i].'</br>';
							if($tipoCampo[$i] == 'Fecha')
							{
									/*$date = date_create_from_format('Y-m-d H:i:s', $valor);
									$valor = $date->format('Y-m-d H:i:s');
									echo $valor;*/
							}
							elseif ($tipoCampo[$i] == 'Cadena')
							{

							}
							elseif ($tipoCampo[$i] == 'Entero')
							{

							}
							elseif ($tipoCampo[$i] == 'Flotante')
							{

							}
							else
							{

							}
							echo $valor.';';
							$i++;
							//$file_o = fopen('C:\\Users\\alopez\\Documents\\archivo_o.txt', "a");
							//fwrite($file_o,fgets($valor).';');
							//fclose($file_o);
					}
					else
					{
						echo $valor.';';
						//echo 'i= '.$i.'</br>';
						//$file_o = fopen('C:\\Users\\alopez\\Documents\\archivo_o.txt', "a");
						//fwrite($file_o,fgets($file_i).PHP_EOL);
						//fclose($file_o);
					}
				}
			}
			//$file_o = fopen('C:\\Users\\alopez\\Documents\\archivo_o.txt', "a");
			//fwrite($file_o,fgets($file_i).PHP_EOL);
			//fclose($file_o);
			//fclose($file_i);
	}
}

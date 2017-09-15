<?
require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';
$links = array("https://forlap.ristekdikti.go.id/prodi/detail/Q0JCNjY4QTItMTYwMC00RjI1LUE4QUMtM0I0MTNEREVEODk4"
);
for($i = 0; $i < count($links); $i++)
	{
			$link = file_get_html($links[$i]);
			if($link)
				{
			foreach($link->find("//[@id='mahasiswa']/table/tbody/tr") as $element)
			{
				$totalcountofstudenteachsemester	= 	$element->find("td[3]/a" , 0)->plaintext;
				$number 				= 	$totalcountofstudenteachsemester / 20;
				$Pages 					=   	(int)$number;
				$student 				= 	$element->find("td[3]/a" , 0)->href;
				
					if($student)
					{
						for($loop = 0; $loop <= $totalcountofstudenteachsemester; $loop+=20)
						{
							$urls =  $student . "/". $loop;
							if($urls !== "/0" || $urls !==  null || $urls !==  "")
							{
								$DAKUMENTPAGE = file_get_html($urls);
								foreach($DAKUMENTPAGE->find("/html/body/div[2]/div[2]/div[2]/div[1]/div/table/tbody/tr") as $SARTOUT)
									{
										$SerNo 		= $SARTOUT->find("td", 0)->plaintext;
										$NIM 		= $SARTOUT->find("td", 1)->plaintext;
										$Name 		= $SARTOUT->find("td" , 2)->plaintext;
										$Namehref 	= $SARTOUT->find("td/a" , 0)->href;
									
											$Pagestudent = file_get_html($Namehref);
											if($Pagestudent)
											{
											//This is Details of Students.
											$Nama 				= $Pagestudent->find("/html/body/div[2]/div[2]/div[2]/div[1]/div/table/tbody/tr[1]/td[3]",0)->plaintext;
											$Jenis  			= $Pagestudent->find("/html/body/div[2]/div[2]/div[2]/div[1]/div/table/tbody/tr[2]/td[3]",0)->plaintext;
											$Perguruan   			= $Pagestudent->find("/html/body/div[2]/div[2]/div[2]/div[1]/div/table/tbody/tr[4]/td[3]",0)->plaintext;
											$Program    			= $Pagestudent->find("/html/body/div[2]/div[2]/div[2]/div[1]/div/table/tbody/tr[5]/td[3]",0)->plaintext;
											$Nomor    			= $Pagestudent->find("/html/body/div[2]/div[2]/div[2]/div[1]/div/table/tbody/tr[6]/td[3]",0)->plaintext;
											$Semester			= $Pagestudent->find("/html/body/div[2]/div[2]/div[2]/div[1]/div/table/tbody/tr[7]/td[3]",0)->plaintext;
											$Status_Awal 			= $Pagestudent->find("/html/body/div[2]/div[2]/div[2]/div[1]/div/table/tbody/tr[8]/td[3]",0)->plaintext;
											$Status_Mahasiswa		= $Pagestudent->find("/html/body/div[2]/div[2]/div[2]/div[1]/div/table/tbody/tr[9]/td[3]",0)->plaintext;												
											
														     
								  $record = array( 'num' =>$Nomor, 'name' => $Nama,'jenis' => $Jenis , 'perguruan' => $Perguruan , 'program' => $Program, 'semester' => $Semester, 'statusawal' => $Status_Awal , 'statusmahasiswa' => $Status_Mahasiswa, 'namehref' => $Namehref, 'link' => $links[$i]);
            								scraperwiki::save(array('num','name','jenis','perguruan','program','semester','statusawal','statusmahasiswa','namehref','link'), $record); 							     
										
											
									
											}							
											 
										
										
										
									}
							}
						}
				
					}
			}
				}
	}

?>

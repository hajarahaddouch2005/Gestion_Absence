<?php
 
mysqli_connect('localhost','root','','projet_gestion');

$query="SELECT MONTH( date_absence ) AS mois, COUNT( * )AS nbwo,id_stag as stag  from absence GROUP BY id_stag ORDER BY mois ASC ";

if(!mysqli_query($query))
echo mysqli_error();
 
$i=0;
$element=array();
$js=array();
while($row=mysqli_fetch_object($query))
{
//Prendre la premiere quantite vendue comme le minimum et maximum
//Mettre les noms de produit et les mois de ventes dans des tableaux
if($i==0)
{
$min=$row->nbwo;
$max=$row->nbwo;
array_push($element, $row->stag);
array_push($js, $row->mois);
}
//Inserer le nom de produit dans le tableau s'il n'est pas encore enregistrer
if(!in_array($row->stag,$element))
{
array_push($element, $row->stag);
}
//Inserer le mois de vente dans le tableau s'il n'est pas encore enregistrer
if(!in_array($row->mois,$js))
{
array_push($js, $row->mois);
}
 
if($row->nbwo < $min)
{
$min=$row->nbwo;
}
else
{
if($row->nbwo > $max)
{$max=$row->nbwo;}
}
$i++;
}
//Mettre les mois en Francais dans un tableau
$moisFr=array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre');
 
//type mime de l'image
header('Content-type: image/png');
//Chemin vers le police à utiliser
$font_file = './arial.ttf';
//Adapter la largeur de l'image par rapport au nombre de ligne et nombre de mois
$largeur=$i*20+(count($js)*10)+100;
$hauteur=400;
$absis=80;
$courbe=imagecreatetruecolor($largeur, $hauteur);
//Générer un tableau de couleurs
$couleur=array();
$red=0;
$blue=0;
$green=0;
for($n=0;$n<count($element);$n++)
{
$x = $n%3;
switch ($x){
case(0):
$red+=85;
break;
case(1):
$blue+=85;
break;
case(2):
$green+=85;
break;
}
$couleur[$n]=imagecolorallocate($courbe, $red,$green , $blue);
}
//Les autre couleurs utils
$ligne=imagecolorallocate($courbe, 220, 220, 220);
$fond=imagecolorallocate($courbe, 250, 250, 250);
$noir=imagecolorallocate($courbe, 0, 0, 0);
$blanc=imagecolorallocate($courbe, 255, 255, 255);
$rouge=imagecolorallocate($courbe, 255, 0, 0);
//Colorer le fond
imagefilledrectangle($courbe,0 , 0, $largeur, $hauteur, $fond);
//Tracer l'abscisse et l'ordonnée
imageline($courbe, 50, $hauteur-$absis, $largeur-10,$hauteur-$absis, $noir);
imageline($courbe, 50,$hauteur-$absis,50,20, $noir);
if($min!=0)
{
$absis+=30;
$a=30;
}
$nbOrdonne=10;
//Calculer les échelles suivants les abscisses et ordonnées
$echelleX=($largeur-90-((count($js)*10)))/$i;
$echelleY=($hauteur-$absis-20)/$nbOrdonne;
$i=$min;
$py=($max-$min)/$nbOrdonne;
$pasY=$absis;
//Tracer les grides
while($pasY<($hauteur-19))
{
imagestring($courbe, 2,10 , $hauteur-$pasY-6, round($i), $noir);
imageline($courbe, 50, $hauteur-$pasY, $largeur-20,$hauteur-$pasY, $ligne);
$pasY+=$echelleY;
$i+=$py;
}
$pasX=60;
mysqli_data_seek($query, 0);
$mois=0;
while($row=mysqli_fetch_object($query))
{
if($mois<($row->mois))
{
//Ecrire le mois en Français en abscisse
imagestring($courbe, 2, $pasX,$hauteur-$absis+32 , $moisFr[$row->mois-1], $noir);
//Décaller 10 px du mois précédent
$pasX+=10;
}
//Calculer la hauteur de la rectangle
$y=($hauteur) -(($row->nbwo -$min) * ($echelleY/$py))-$absis;
//Prendre la couleur correspondante au produit
$clr=$couleur[array_search($row->stag, $element)];
//Dessiner le rectangle
imagefilledrectangle($courbe,$pasX-10 , $hauteur-$absis+$a, $pasX+10, $y, $clr);
//Ecrire la valeur en verticale
imagefttext($courbe, 10, 270, $pasX-3, $y+5, $blanc, $font_file, $row->nbwo);
//Decaller le prochain rectangle
$pasX+=$echelleX;
$mois=$row->mois;
}
//La legende
$pasX=50;
//Hauteur de la premiere
$pasY=$hauteur-$absis+47;
foreach ($element as $index=>$libelle)
{
if(($index % 4)==3)
{
$pasX+=120;
$pasY=$hauteur-$absis+47;
}
//Le nom du poduit avec sa couleur
imagestring($courbe, 2, $pasX,$pasY , $libelle, $couleur[$index]);
//Un petit rectangle 
imagefilledrectangle($courbe,$pasX+80 , $pasY, $pasX+100, $pasY+12, $couleur[$index]);
$pasY+=20;
}
imagepng($courbe,$file_img_bar);
return $file_img_bar;
?>
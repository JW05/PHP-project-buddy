
<?php
class User{
var $locatie;
var $jaar;
var $voorkeur;
var $genre;
var $feesten;

}





?>
<li>kenmerk 1:

<?php
$User = new User();
$User ->locatie = "locatie";
echo $User ->locatie;
?>

</li>

<li>kenmerk 2:

<?php
$User = new User();
$User ->jaar = "jaar";
echo $User ->jaar;
?>

</li>

<li>kenmerk 3:

<?php
$User = new User();
$User ->voorkeur = "voorkeur";
echo $User ->voorkeur;
?>

</li>

<li>kenmerk 4:

<?php
$User = new User();
$User ->genre = "genre";
echo $User ->genre;
?>

</li>

<li>kenmerk 5:

<?php
$User = new User();
$User ->feesten = "feesten";
echo $User ->feesten;
?>

</li>

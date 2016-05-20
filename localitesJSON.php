<?
$tabRes=array();
include "connexion/connexion.php";
$debutCodeCommune=$_GET['debutCommune'];
$requete="select CP,ville from localites where CP like '$debutCodeCommune%'";
$curseur=mysqli_query($laBase,$requete);
while($tab=mysqli_fetch_assoc($curseur))
{
        $tabRes[]=$tab;
}
echo json_encode($tabRes);
?>

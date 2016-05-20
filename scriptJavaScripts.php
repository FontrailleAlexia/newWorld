<?###############JAVASCRIPT COMMUNE############################?>
<script>
//######CETTE FONCTION SE LANCE QUAND LA COMMUNE CHANGE########
//#########MET A JOUR LA LISTE DES COMMUNES COMMENÇANT PAR CE QUI A ÉTÉ SAISI PAR L'USER
function remplirListeCommune()
{
	//######RECUPERATION DU DEBUT DU CODE POSTAL DE LA COMMUNE######
	var debutCodeCommune=document.getElementById('idCommune').value;
	//#######ON COMMENCE A PARTIR DE 3 CARACTERES
	if(debutCodeCommune.length>2)
	{
		var dataListeCommunes=document.getElementById('listeDesCommunes');
		//################EFFACEMENT DES OPTIONS DE LA DATALIST
		while(dataListeCommunes.options.length>0)
		{
			dataListeCommunes.removeChild(dataListeCommunes.childNodes[0]);
		}
		//######JE CREE MA REQUETE VERS LE SERVEUR PHP
		var request = new XMLHttpRequest();
		//######CHANGEMENT D'ETAT DE LA REQUETE
		request.onreadystatechange = function(response) 
		{
			if (request.readyState === 4) 
			{
				if(request.status===200)
				{
					//####J'OBTIENT LA REP AU FORMAT JSON ET L'ANALYSE
					var tabJsonOptions=JSON.parse(request.responseText);
					//####POUR CHAQUE LIGNE DU TABLEAU RECU
					var noLigne;
					for(noLigne=0;noLigne<tabJsonOptions.length;noLigne++)
					{
						//###NOUVELLE OPTION
						var nouvelleOption = document.createElement('option');
						//###ON RENSEIGNE LA VALUE DE L'OPTION AVEC LE NUM DU PRODUIT
						nouvelleOption.value = tabJsonOptions[noLigne].CP+';'+tabJsonOptions[noLigne].ville;
						//####ON AFFICHE LE CP ET LA COMMUNE
						nouvelleOption.text=nouvelleOption.value;
						//####AJOUT DE L'OPTION EN TANT QU'ENFANT DE LA LISTE DE LA SELECTION DES PRODUITS
						dataListeCommunes.appendChild(nouvelleOption);
					}
				}
				else
				{
					//ERROR
					alert("Couldn't load datalist options");
				}
			}
		};
		//####RECUP DU DEBUT DU CP ET DE LA COMMUNE
		var debutCodeCommune=document.getElementById('idCommune').value;
		//####FORMATION DU TXT DE LA REQUETE
		var texteRequeteAjax='localitesJSON.php?debutCommune='+debutCodeCommune;
		//####ON L'OUVRE
		request.open('GET', texteRequeteAjax, true);
		//####ON L'ENVOIE
		request.send();
	}//####FIN DU SI + DE 2 CARACTÈRES ONT ÉTÉ SAISI
}
</script>

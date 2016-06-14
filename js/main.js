$( ".datepicker" ).datepicker({
	altField: ".datepicker",
	closeText: 'Fermer',
	prevText: 'Précédent',
	nextText: 'Suivant',
	currentText: 'Aujourd\'hui',
	monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
	monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
	dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
	dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
	dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
	weekHeader: 'Sem.',
	dateFormat: 'dd/mm/yy'
});


$('.spinner').spinner({
    min: 0,
    create: function (event, ui) {
        $(this).closest(".ui-spinner").addClass('col-xs-12');
        $(this).closest(".ui-spinner").css("font-size", "small");
        $(this).closest(".ui-spinner .ui-spinner-input").css("margin", "0");
        $(this).closest(".ui-spinner .ui-spinner-input").css("padding-left", "10px");
    }
});



var options = {
    //PUVODNI TESTOVACI SKRIPT// script:"autosuggest/test.php?json=true&limit=99990&",
    script: "autosuggest/generator.php?json=true&limit=99990&Bakalarsky",
    varname: "input",
    json: true,
    shownoresults: true,
    maxresults: 10
    //callback: function (obj) { document.getElementById('klicove_slovo_id').value = obj.id; }
};
var as_json = new bsn.AutoSuggest('klicove_slovo', options);

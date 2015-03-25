<!DOCTYPE HTML>
<html>
  <head>
	  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	  <meta name="generator" content="PSPad editor, www.pspad.com" />
	  <link rel="stylesheet" href="style.css" />
	  <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
	  <script type="text/javascript" src="funkce.js"></script>
	  <title></title>
  </head>
  <body>
    <div id="header">
      <div id="header_content">
        <a href="index.php"><img src="titulka_logo.png" alt="" /></a>
      </div>
    </div>
    <div id="page">
        <div id="page_content">
        	<div class='bunka'>
            <h1>Výběr studijního oboru na FAV</h1>
	            <p>
	            Informace o fakultě, oborech a přijímacím řízení: <a href="http://fav.zcu.cz/pro-uchazece/">http://fav.zcu.cz/pro-uchazece/</a>
	            <br>
	            Informace o studijních programech, oborech a studjiní plány najdete zde: <a href="https://portal.zcu.cz/portal/prohlizeni.html">Portál ZČU</a>
	            </p>
	            <p>Pomocí formuláře níže zadejte oblasti (předměty) a klíčová slova, která se Vám libí a na jejich základě se zobrazí
	            graf se studijními obory, které Fakulta aplikovaných věd (FAV) nabízí.</p>
	            <p>
	            Pokud nevyberete nic zobrazí se všechny obory.
							</p>
					</div>
						<form>
							<div class='bunka noborder' style='padding-bottom: 5px;'>
		            <span class='bold'>Forma studia</span>
		            <select name="forma" id="forma_studia" onchange="zobrazCast1();">
		            	<option value="0">--Vyber formu studia--</option>
		              <option value="prezencni">Prezenční</option>
		              <option value="kombinovane">Kombinovaná</option>
		              <option value="obe">Prezenční, kombinovaná</option>
		            </select>
		            &nbsp;&nbsp;&nbsp;
		            <span class='bold'>Typ studia</span>
		            <select name="typ" id="typ_studia" onchange="zobrazCast1();">
		            	<option value="0">--Vyber typ studia--</option>
		              <option value="BC">Bakalářské</option> 
		              <option value="MGR">Navazující (Mgr)</option>
		              <option value="DOC">Doktorské</option> 
		            </select>
		         	</div>               
		          <div id="cast1">
		          	<div class='infobox'>Vyberte formu a typ studia</div>
		          </div>
		        </form>
            
          <div id="page_footer">
            <table>
              <tr><th>Fakulta aplikovaných věd</th><th>Studium</th><th>Výzkum a vývoj</th><th>Zahraniční vztahy</th></tr>
              <tr><td><a href="#">Kontakty</a></td><td><a href="#">Kontakty</a></td><td><a href="#">Kontakty</a></td><td><a href="#">Kontakty</a></td></tr>
              <tr><td></td><td><a href="#">Kontakty</a></td><td><a href="#">Kontakty</a></td><td><a href="#">Kontakty</a></td></tr>
            </table>
          </div>
        </div>
    </div>
    <div id="footer">
      <div id="footer_content">
        <a href="index.php"><img src="footer_logo.png" alt="" class="logo"></a>
        <div class="copyright">
           &copy; 2015 FAV ZČU v Plzni<br>
           Univerzitní 8, Pilsen, Czech Republic
        </div>
      </div>
    </div>
		<table id="loading">
			<tr><td><span>loading</span></td></tr>
		</table>
		<input type='hidden' name='zobrazeni_prvni_casti' id="zobrazeni_prvni_casti" value="0" />
    </body>
</html>

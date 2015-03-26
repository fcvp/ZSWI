<div class='oblast' id="oblast_<?php echo $_GET["oblast"];?>">
	<table class='oblast_hlavicka'>
		<tr>
		  <td style='width: 20px;'>
		      <img src='image/cross.png' alt='Odebrat oblast' title='Odebrat oblast' class='odebrat_oblast' onclick="odeberOblast('oblast_<?php echo $_GET["oblast"];?>');" />
		  </td>
		  <td>
		     <b><?php echo $_GET["oblast"];?></b>
		  </td>
		  <td>
		      <input type="radio" name="mat" value="1">
		      ne 
		      <input type="radio" name="mat" value="2">spíše ne 
		      <input type="radio" name="mat" value="3" checked="checked">nevadí mi
		      <input type="radio" name="mat" value="4">spíše ano  
		      <input type="radio" name="mat" value="5">
		      ano
		      &nbsp;&nbsp;&nbsp;
		      <input type="button" title="Hodnocení u oblasti se aplikuje i na klíčová slova, která k ní patří." value="Aplikovat hodnocení" />
		  </td>
		</tr>
	</table>
	
	<table class='oblast_telo'>
	  <tr>
	      <td>
	          <b>Matematika (není hlavní náplní oboru) </b>
	      </td>
	      <td>
	          <input type="radio" class='klicovy_termin' name="m" value="1">
	          ne 
	          <input type="radio" class='klicovy_termin' name="m" value="2">spíše ne 
	          <input type="radio" class='klicovy_termin' name="m" value="3" checked="checked">nevadí mi
	          <input type="radio" class='klicovy_termin' name="m" value="4">spíše ano  
	          <input type="radio" class='klicovy_termin' name="m" value="5">
	          ano
	      </td>
	  </tr>
	  <tr>
	      <td>
	          <b>Finanční matematika  </b>
	      </td>
	      <td>
	          <input type="radio" class='klicovy_termin' name="fi" value="1" checked="checked">
	          ne 
	          <input type="radio" class='klicovy_termin' name="fi" value="2">spíše ne 
	          <input type="radio" class='klicovy_termin' name="fi" value="3">nevadí mi
	          <input type="radio" class='klicovy_termin' name="fi" value="4">spíše ano  
	          <input type="radio" class='klicovy_termin' name="fi" value="5">
	          ano
	      </td>
	  </tr>
	  <tr>
	      <td>
	          <b>Pojistná matematika</b>
	      </td>
	      <td>
	          <input type="radio" class='klicovy_termin' name="pm" value="horni" checked="checked">
	          ne 
	          <input type="radio" class='klicovy_termin' name="pm" value="dolni">spíše ne 
	          <input type="radio" class='klicovy_termin' name="pm" value="dolni">nevadí mi
	          <input type="radio" class='klicovy_termin' name="pm" value="dolni">spíše ano  
	          <input type="radio" class='klicovy_termin' name="pm" value="dolni">
	          ano
	      </td>
	  </tr>
	  <tr>
	      <td>
	          <b>Statistika a pravděpodobnost</b>
	      </td>
	      <td>
	          <input type="radio" class='klicovy_termin' name="stat" value="1" checked="checked">
	          ne 
	          <input type="radio" class='klicovy_termin' name="stat" value="2">spíše ne 
	          <input type="radio" class='klicovy_termin' name="stat" value="3">nevadí mi
	          <input type="radio" class='klicovy_termin' name="stat" value="4">spíše ano  
	          <input type="radio" class='klicovy_termin' name="stat" value="5">
	          ano
	      </td>
	  </tr>
	  <tr>
	      <td>
	          <b>Matematická analýza</b>
	      </td>
	      <td>
	          <input type="radio" class='klicovy_termin' name="matan" value="1">
	          ne 
	          <input type="radio" class='klicovy_termin' name="matan" value="2" checked="checked">spíše ne 
	          <input type="radio" class='klicovy_termin' name="matan" value="3">nevadí mi
	          <input type="radio" class='klicovy_termin' name="matan" value="4">spíše ano  
	          <input type="radio" class='klicovy_termin' name="matan" value="5">
	          ano
	      </td>
	  </tr>
	  <tr>
	      <td>
	          <b>Lineární algebra</b>
	      </td>
	      <td>
	          <input type="radio" class='klicovy_termin' name="la" value="1">
	          ne 
	          <input type="radio" class='klicovy_termin' name="la" value="2">spíše ne 
	          <input type="radio" class='klicovy_termin' name="la" value="3" checked="checked">nevadí mi
	          <input type="radio" class='klicovy_termin' name="la" value="4">spíše ano  
	          <input type="radio" class='klicovy_termin' name="la" value="5">
	          ano
	      </td>
	  </tr>
	  <tr>
	      <td>
	          <b>Diskrétní matematika</b>
	      </td>
	      <td>
	          <input type="radio" class='klicovy_termin' name="dm" value="1">
	          ne 
	          <input type="radio" class='klicovy_termin' name="dm" value="2" checked="checked">spíše ne 
	          <input type="radio" class='klicovy_termin' name="dm" value="3">nevadí mi
	          <input type="radio" class='klicovy_termin' name="dm" value="4">spíše ano  
	          <input type="radio" class='klicovy_termin' name="dm" value="5">
	          ano
	      </td>
	  </tr>
	  <tr>
	      <td>
	          <b>Numerické metody</b>
	      </td>
	      <td>
	          <input type="radio" class='klicovy_termin' name="nm" value="horni">
	          ne 
	          <input type="radio" class='klicovy_termin' name="nm" value="dolni">spíše ne 
	          <input type="radio" class='klicovy_termin' name="nm" value="dolni" checked="checked">nevadí mi
	          <input type="radio" class='klicovy_termin' name="nm" value="dolni">spíše ano  
	          <input type="radio" class='klicovy_termin' name="nm" value="dolni">
	          ano
	      </td>
	  </tr>
	  <tr>
	    <td colspan="2">
	        <br>
	        <h3>Související obory s oblastí Matematika: </h3>
	    </td>
		</tr>
		<tr>
	    <td colspan="2">
	      <ul>
	        <li class='bold'>Finanční informatika a statistika </li>
	        <li class='bold'>Matematika a finanční studia </li>
	        <li class='bold'>Matematika a její aplikace  </li>
				</ul>
	    </td>
		</tr>
	</table>
</div>
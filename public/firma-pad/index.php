<?php
	if(isset($_POST["accion"]) && $_POST["accion"] == "firmar"){
		function base64_to_png($base64_string, $output_file) {
		    $ifp = fopen( $output_file, 'wb' ); 
		    $data = explode( ',', $base64_string );
		    fwrite( $ifp, base64_decode( $data[ 1 ] ) );
		    fclose( $ifp ); 
		    return $output_file; 
		}
		// AQUI ES DONDE COLOCARÁS EL ID DEL USUARIO DE LA SOLICITUD O USUARIO
		$idguardar = time();
		
		// AQUI VA EL NOMBRE DEL ARCHIVO DONDE SE VA A GUARDAR LA FIRMA
		// PUEDES TAMBIEN GUARDAR EN LA BD EL NOMBRE EL ARCHIVO
		$nomarch = "firma".$idguardar.".png";
		
		// AQUI SE ALMACENA EN FORMATO JSON LA FIRMA PARA GUARDAR EN BASE DE DATOS Y
		// REGENERAR EN CASO NECESARIO
		$datojson = $_POST["json_imagen"];
		
		// GENERAS EL PNG Y LO GUARDAS EN SERVIDOR
		base64_to_png($_POST["datos_imagen"],$nomarch);
?>
<!-- <img src="<?php echo $_POST["datos_imagen"]; ?>"> -->
<script>
	alert("La firma se ha guardado correctamente.");
	window.location = "./";
</script>
<?php
	}else{
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>jQuery Signature Pad Examples</title>
		<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
		<style>
		body {
		font: normal 100.01%/1.375 "Helvetica Neue", Helvetica, Arial, sans-serif;
		}
		</style>
		<link href="./assets/jquery.signaturepad.css" rel="stylesheet">
		<!--[if lt IE 9]><script src="./assets/flashcanvas.js"></script><![endif]-->
		
	</head>
	<body>
		<h1>Capture su firma</h1>
		<form method="post" action="" onsubmit="return enviar_datos()">
			<input type="hidden" name="accion" value="firmar">
			<input type="hidden" name="datos_imagen" id="datos_imagen" value="">
			<input type="hidden" name="json_imagen" id="json_imagen" value="">
			<div class="sigPad" id="linear" style="width:404px;">
				<ul class="sigNav">
					<li class="drawIt"><a href="#draw-it" >Firma</a></li>
					<li class="clearButton"><a href="#clear">Borrar</a></li>
				</ul>
				<div class="sig sigWrapper" style="height:auto;">
					<div class="typed"></div>
					<canvas class="pad" width="400" height="250"></canvas>
					<input type="hidden" name="output" class="output">
				</div>
			</div>
			<button type="submit">Enviar firma.</button> <button type="button" onclick="obtener_imagen()">Obtener imagen</button>
		</form>
		<img id="imagen" width="400">
		<p id="datos"></p>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="./assets/numeric-1.2.6.min.js"></script> 
		<script src="./assets/bezier.js"></script> 
		<script src="./jquery.signaturepad.js"></script>
		<script src="./assets/json2.min.js"></script> 
		<script>
			var firma = $('#linear');
			$(document).ready(function() {
				/*let datos = '[{"lx":120,"ly":104,"mx":120,"my":103},{"lx":119,"ly":103,"mx":120,"my":104},{"lx":116,"ly":105,"mx":119,"my":103},{"lx":114,"ly":108,"mx":116,"my":105},{"lx":113,"ly":111,"mx":114,"my":108},{"lx":106,"ly":119,"mx":113,"my":111},{"lx":101,"ly":126,"mx":106,"my":119},{"lx":98,"ly":131,"mx":101,"my":126},{"lx":96,"ly":134,"mx":98,"my":131},{"lx":95,"ly":137,"mx":96,"my":134},{"lx":93,"ly":143,"mx":95,"my":137},{"lx":94,"ly":150,"mx":93,"my":143},{"lx":97,"ly":155,"mx":94,"my":150},{"lx":106,"ly":163,"mx":97,"my":155},{"lx":118,"ly":167,"mx":106,"my":163},{"lx":131,"ly":168,"mx":118,"my":167},{"lx":141,"ly":166,"mx":131,"my":168},{"lx":147,"ly":160,"mx":141,"my":166},{"lx":149,"ly":156,"mx":147,"my":160},{"lx":149,"ly":152,"mx":149,"my":156},{"lx":148,"ly":143,"mx":149,"my":152},{"lx":142,"ly":134,"mx":148,"my":143},{"lx":139,"ly":132,"mx":142,"my":134},{"lx":135,"ly":131,"mx":139,"my":132},{"lx":133,"ly":131,"mx":135,"my":131},{"lx":132,"ly":131,"mx":133,"my":131},{"lx":134,"ly":134,"mx":132,"my":131},{"lx":137,"ly":139,"mx":134,"my":134},{"lx":139,"ly":141,"mx":137,"my":139},{"lx":141,"ly":145,"mx":139,"my":141},{"lx":143,"ly":152,"mx":141,"my":145},{"lx":143,"ly":161,"mx":143,"my":152},{"lx":171,"ly":128,"mx":171,"my":127},{"lx":171,"ly":127,"mx":171,"my":128},{"lx":172,"ly":129,"mx":171,"my":127},{"lx":173,"ly":136,"mx":172,"my":129},{"lx":179,"ly":156,"mx":173,"my":136},{"lx":182,"ly":164,"mx":179,"my":156},{"lx":182,"ly":166,"mx":182,"my":164},{"lx":182,"ly":165,"mx":182,"my":166},{"lx":182,"ly":163,"mx":182,"my":165},{"lx":185,"ly":50,"mx":185,"my":49},{"lx":186,"ly":49,"mx":185,"my":50},{"lx":193,"ly":65,"mx":186,"my":49},{"lx":198,"ly":76,"mx":193,"my":65},{"lx":227,"ly":141,"mx":198,"my":76},{"lx":243,"ly":180,"mx":227,"my":141},{"lx":253,"ly":201,"mx":243,"my":180},{"lx":256,"ly":208,"mx":253,"my":201},{"lx":257,"ly":209,"mx":256,"my":208},{"lx":257,"ly":207,"mx":257,"my":209}]';
				firma.signaturePad({drawOnly:true, lineTop:200}).regenerate(datos);*/
				firma.signaturePad({drawOnly:true, lineTop:200, bgColour: 'transparent'});
			});
			
			function obtener_imagen(){
				//$("#imagen").attr("src",firma.signaturePad().getSignatureImage());
				//$("#datos").html(firma.signaturePad().getSignatureString());
				$("#datos_imagen").val(firma.signaturePad().getSignatureImage());
				$("#json_imagen").val(firma.signaturePad().getSignatureString());
				alert($("#json_imagen").val());
			}
			
			function enviar_datos(){
				$("#datos_imagen").val(firma.signaturePad().getSignatureImage());
				$("#json_imagen").val(firma.signaturePad().getSignatureString());
				if($("#json_imagen").val() == "[]"){
					alert("Debe introducir su firma en el espacio.");
					return false;
				}else{
					if(confirm("¿Desea enviar esta firma?")){
						return true;
					}else{
						return false;
					}
				}
			}
		</script> 
	</body>
</html>
<?php
	}	
?>
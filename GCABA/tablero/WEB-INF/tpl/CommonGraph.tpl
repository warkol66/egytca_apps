		 <script type="text/javascript" src="scripts/GoogleGraph.js"></script> 
    <script type="text/javascript"> 
        google.load('visualization', '1', {'packages':['motionchart'], 'language' : 'es'}); 
        google.setOnLoadCallback(drawChart); 
        function drawChart() { 
            var data = new google.visualization.DataTable(); 
            data.addRows(34);  //Cantidad de Proyectos 
            data.addColumn('string', 'Proyectos'); 
            data.addColumn('number', 'Año'); 
            data.addColumn('number', 'Duración'); 
            data.addColumn('number', 'Impacto'); 
            data.addColumn('number', 'Presupuesto');
            data.addColumn('string', 'Localidad');
            data.addColumn('string', 'Departamento');
            data.addColumn('string', 'Dependencia');
            data.addColumn('string', 'Estado');
            data.setValue(0, 0, 'BARRIO POTCHSKA '); 
data.setValue(0, 1, 2010); 
data.setValue(0, 2, 14); 
data.setValue(0, 3, 0.52); 
data.setValue(0, 4, 2169126.44); 
data.setValue(0, 5, 'LEANDRO N. ALEM'); 
data.setValue(0, 6, 'Leandro N. Alem'); 
data.setValue(0, 7, 'UEP-PROMEBA'); 
data.setValue(0, 8, 'Ejecutado'); 
data.setValue(1, 0, 'BARRIO OESTE '); 
data.setValue(1, 1, 2010); 
data.setValue(1, 2, 16); 
data.setValue(1, 3, 0.52); 
data.setValue(1, 4, 3083108.31); 
data.setValue(1, 5, 'Campo Viera'); 
data.setValue(1, 6, 'Oberá'); 
data.setValue(1, 7, 'UEP-PROMEBA'); 
data.setValue(1, 8, 'Ejecutado'); 
data.setValue(2, 0, 'BARRIO CAPILLA '); 
data.setValue(2, 1, 2010); 
data.setValue(2, 2, 15); 
data.setValue(2, 3, 0.54); 
data.setValue(2, 4, 3791153.44); 
data.setValue(2, 5, 'JARDIN AMERICA'); 
data.setValue(2, 6, 'San Ignacio'); 
data.setValue(2, 7, 'UEP-PROMEBA'); 
data.setValue(2, 8, 'En Ejecución'); 
data.setValue(3, 0, 'BARRIO SAN CAYETANO / SANTA CATALINA '); 
data.setValue(3, 1, 2010); 
data.setValue(3, 2, 19); 
data.setValue(3, 3, 0.54); 
data.setValue(3, 4, 2083408.65); 
data.setValue(3, 5, 'Eldorado'); 
data.setValue(3, 6, 'Eldorado'); 
data.setValue(3, 7, 'UEP-PROMEBA'); 
data.setValue(3, 8, 'Ejecutado'); 
data.setValue(4, 0, 'BARRIO MUNICIPAL '); 
data.setValue(4, 1, 2010); 
data.setValue(4, 2, 13); 
data.setValue(4, 3, 0.54); 
data.setValue(4, 4, 4169817); 
data.setValue(4, 5, 'ARISTOBULO DEL VALLE'); 
data.setValue(4, 6, 'Cainguás'); 
data.setValue(4, 7, 'UEP-PROMEBA'); 
data.setValue(4, 8, 'En Ejecución'); 
data.setValue(5, 0, 'BARRIO CAPIOVICITO '); 
data.setValue(5, 1, 2010); 
data.setValue(5, 2, 14); 
data.setValue(5, 3, 0.54); 
data.setValue(5, 4, 1923295.31); 
data.setValue(5, 5, 'CAPIOVI'); 
data.setValue(5, 6, 'Lib. Gral. San Martín'); 
data.setValue(5, 7, 'UEP-PROMEBA'); 
data.setValue(5, 8, 'Ejecutado'); 
data.setValue(6, 0, 'BARRIO MUNICIPAL '); 
data.setValue(6, 1, 2010); 
data.setValue(6, 2, 12); 
data.setValue(6, 3, 0.54); 
data.setValue(6, 4, 1293175.64); 
data.setValue(6, 5, 'Puerto Rico'); 
data.setValue(6, 6, 'Lib. Gral. San Martín'); 
data.setValue(6, 7, 'UEP-PROMEBA'); 
data.setValue(6, 8, 'Ejecutado'); 
data.setValue(7, 0, 'BARRIO SANTA RITA '); 
data.setValue(7, 1, 2010); 
data.setValue(7, 2, 13); 
data.setValue(7, 3, 0.56); 
data.setValue(7, 4, 4220570); 
data.setValue(7, 5, 'BERNARDO DE IRIGOYEN'); 
data.setValue(7, 6, 'Gral. M. Belgrano'); 
data.setValue(7, 7, 'UEP-PROMEBA'); 
data.setValue(7, 8, 'En Ejecución'); 
data.setValue(8, 0, 'BARRIO SOL NACIENTE CH96 '); 
data.setValue(8, 1, 2010); 
data.setValue(8, 2, 14); 
data.setValue(8, 3, 0.5); 
data.setValue(8, 4, 4298830.81); 
data.setValue(8, 5, 'Posadas'); 
data.setValue(8, 6, 'Capital'); 
data.setValue(8, 7, 'UEP-PROMEBA'); 
data.setValue(8, 8, 'En Ejecución'); 
data.setValue(9, 0, 'BARRIO SAN MIGUEL '); 
data.setValue(9, 1, 2010); 
data.setValue(9, 2, 13); 
data.setValue(9, 3, 0.52); 
data.setValue(9, 4, 6192018.17); 
data.setValue(9, 5, 'Oberá'); 
data.setValue(9, 6, 'Oberá'); 
data.setValue(9, 7, 'UEP-PROMEBA'); 
data.setValue(9, 8, 'En Ejecución'); 
data.setValue(10, 0, 'Ejecucion de cordon cuneta,  badenes y mejoramiento de calles en Barrio Unidos.'); 
data.setValue(10, 1, 2010); 
data.setValue(10, 2, 9); 
data.setValue(10, 3, 0.52); 
data.setValue(10, 4, 565134.9); 
data.setValue(10, 5, 'Cerro Azul'); 
data.setValue(10, 6, 'Leandro N. Alem'); 
data.setValue(10, 7, 'UEP-PROMEBA'); 
data.setValue(10, 8, 'En Ejecución'); 
data.setValue(11, 0, 'Mejoramiento Red Vial Zona Centro y Pavimentacion Parcial Ruta Prov. Nº 103 '); 
data.setValue(11, 1, 2010); 
data.setValue(11, 2, 6); 
data.setValue(11, 3, 0.27); 
data.setValue(11, 4, 9575514.25); 
data.setValue(11, 5, 'Santa Ana'); 
data.setValue(11, 6, 'Candelaria'); 
data.setValue(11, 7, 'VIALIDAD'); 
data.setValue(11, 8, 'En Ejecución'); 
data.setValue(12, 0, 'Mejoramiento y Pavimentacion Zona Norte '); 
data.setValue(12, 1, 2010); 
data.setValue(12, 2, 6); 
data.setValue(12, 3, 0.53); 
data.setValue(12, 4, 163685.25); 
data.setValue(12, 5, ' Zona Norte de la Provincia de Misiones. Municipios PUERTO. Iguazú, PUERTO. Libertad, Wanda, PUERTO. Esperanza, Delicia, Victoria, PUERTO. Piray, 9 de Julio, Garuhapé, Capioví, PUERTO. Rico, Aristóbulo del Valle, San Pedro.'); 
data.setValue(12, 6, 'Sin especificar'); 
data.setValue(12, 7, 'VIALIDAD'); 
data.setValue(12, 8, 'En Ejecución'); 
data.setValue(13, 0, 'Pavimentacin Zona Sur 2ª Etapa '); 
data.setValue(13, 1, 2010); 
data.setValue(13, 2, 16); 
data.setValue(13, 3, 0.55); 
data.setValue(13, 4, 16555778.12); 
data.setValue(13, 5, ' Zona Sur de la Provincia de Misiones. Municipios de Apóstoles, San José, Concepción de la Sierra, Itacaruaré, San Javier, Cerro Azul, Oberá (Autódromo Oberá)'); 
data.setValue(13, 6, 'Sin especificar'); 
data.setValue(13, 7, 'VIALIDAD'); 
data.setValue(13, 8, 'En Ejecución'); 
data.setValue(14, 0, 'Construccion Obras Basicas, Desagües y Pavimento Ruta Prov. Nº 225 '); 
data.setValue(14, 1, 2010); 
data.setValue(14, 2, 18); 
data.setValue(14, 3, 0.47); 
data.setValue(14, 4, 16836081.41); 
data.setValue(14, 5, 'Caa Yarí - Instituto Alberdi - Leandro N. Alem. Municipios Caa Yarí y L.N. Alem - DPUERTO. Leandro N. Alem'); 
data.setValue(14, 6, 'Sin especificar'); 
data.setValue(14, 7, 'VIALIDAD'); 
data.setValue(14, 8, 'En Ejecución'); 
data.setValue(15, 0, 'Obra Basica y Pavimento Acceso Colonia Guarani '); 
data.setValue(15, 1, 2010); 
data.setValue(15, 2, 6); 
data.setValue(15, 3, 0.37); 
data.setValue(15, 4, 2456251.72); 
data.setValue(15, 5, 'Colonia Guaraní'); 
data.setValue(15, 6, 'Oberá'); 
data.setValue(15, 7, 'VIALIDAD'); 
data.setValue(15, 8, 'En Ejecución'); 
data.setValue(16, 0, 'Obras basicas y Pavimento Av. Alte Brown '); 
data.setValue(16, 1, 2010); 
data.setValue(16, 2, 4); 
data.setValue(16, 3, 0.55); 
data.setValue(16, 4, 893715.85); 
data.setValue(16, 5, 'Posadas'); 
data.setValue(16, 6, 'Capital'); 
data.setValue(16, 7, 'VIALIDAD'); 
data.setValue(16, 8, 'En Ejecución'); 
data.setValue(17, 0, 'Obra Basica, Desagüe y Pavimento Av. Marconi '); 
data.setValue(17, 1, 2010); 
data.setValue(17, 2, 6); 
data.setValue(17, 3, 0.55); 
data.setValue(17, 4, 3167107.08); 
data.setValue(17, 5, 'Posadas'); 
data.setValue(17, 6, 'Capital'); 
data.setValue(17, 7, 'VIALIDAD'); 
data.setValue(17, 8, 'En Ejecución'); 
data.setValue(18, 0, 'Obra Basica, Desagüe y Pavimento Av. Tomas Guido '); 
data.setValue(18, 1, 2010); 
data.setValue(18, 2, 16); 
data.setValue(18, 3, 0.55); 
data.setValue(18, 4, 2573978.28); 
data.setValue(18, 5, 'Posadas'); 
data.setValue(18, 6, 'Capital'); 
data.setValue(18, 7, 'VIALIDAD'); 
data.setValue(18, 8, 'En Ejecución'); 
data.setValue(19, 0, 'Construccion Obra Basica, Pavimento y Desagües Av. Blas Parera '); 
data.setValue(19, 1, 2010); 
data.setValue(19, 2, 10); 
data.setValue(19, 3, 0.55); 
data.setValue(19, 4, 5082902.21); 
data.setValue(19, 5, 'Posadas'); 
data.setValue(19, 6, 'Capital'); 
data.setValue(19, 7, 'VIALIDAD'); 
data.setValue(19, 8, 'En Ejecución'); 
data.setValue(20, 0, 'Construccion Obra Basica y Pavimento Ruta Pcial. Nº 2 '); 
data.setValue(20, 1, 2010); 
data.setValue(20, 2, 25); 
data.setValue(20, 3, 0.43); 
data.setValue(20, 4, 40893810.27); 
data.setValue(20, 5, 'El Soberbio'); 
data.setValue(20, 6, 'Guaraní'); 
data.setValue(20, 7, 'VIALIDAD'); 
data.setValue(20, 8, 'En Ejecución'); 
data.setValue(21, 0, 'Construccion Puente sobre Ruta Nac. Nº 14 '); 
data.setValue(21, 1, 2010); 
data.setValue(21, 2, 10); 
data.setValue(21, 3, 0.39); 
data.setValue(21, 4, 1773349.93); 
data.setValue(21, 5, 'Campo Viera'); 
data.setValue(21, 6, 'Oberá'); 
data.setValue(21, 7, 'VIALIDAD'); 
data.setValue(21, 8, 'En Ejecución'); 
data.setValue(22, 0, 'Mejoramiento Red Vial Zona Norte '); 
data.setValue(22, 1, 2010); 
data.setValue(22, 2, 10); 
data.setValue(22, 3, 0.31); 
data.setValue(22, 4, 9171857.31); 
data.setValue(22, 5, ' Zona Norte de la Provincia de Misiones. Municipios de Deseado, Andresito, Paraje Yacutinga, Paraje María Soledad, Piñalito Norte.'); 
data.setValue(22, 6, 'Sin especificar'); 
data.setValue(22, 7, 'VIALIDAD'); 
data.setValue(22, 8, 'En Ejecución'); 
data.setValue(23, 0, ''); 
data.setValue(23, 1, 2010); 
data.setValue(23, 2, 16); 
data.setValue(23, 3, 0.47); 
data.setValue(23, 4, 9089905.55); 
data.setValue(23, 5, ' Zona Sur de la Provincia de Misiones. Municipios de Gobernador Roca, Santo Pipó, Loreto, Corpus, Candelaria y Santa Ana'); 
data.setValue(23, 6, 'Sin especificar'); 
data.setValue(23, 7, 'VIALIDAD'); 
data.setValue(23, 8, 'En Ejecución'); 
data.setValue(24, 0, 'Construccion Obras Basicas y Pavimento Ruta Pcial. Nº 5 '); 
data.setValue(24, 1, 2010); 
data.setValue(24, 2, 16); 
data.setValue(24, 3, 0.55); 
data.setValue(24, 4, 30090128.37); 
data.setValue(24, 5, 'Alberdi - Alvear.  Municipios Alberdi - Alvear - DPUERTO. Oberá'); 
data.setValue(24, 6, 'Oberá'); 
data.setValue(24, 7, 'VIALIDAD'); 
data.setValue(24, 8, 'En Ejecución'); 
data.setValue(25, 0, 'Construccion de conducto Hº Aº Av. Tomas Guido '); 
data.setValue(25, 1, 2010); 
data.setValue(25, 2, 13); 
data.setValue(25, 3, 0.55); 
data.setValue(25, 4, 4900938.87); 
data.setValue(25, 5, 'Posadas'); 
data.setValue(25, 6, 'Capital'); 
data.setValue(25, 7, 'VIALIDAD'); 
data.setValue(25, 8, 'En Ejecución'); 
data.setValue(26, 0, 'Parque Tecnologico y Estacion de Transferencia '); 
data.setValue(26, 1, 2010); 
data.setValue(26, 2, 3); 
data.setValue(26, 3, 0.55); 
data.setValue(26, 4, 288234.49); 
data.setValue(26, 5, 'Posadas'); 
data.setValue(26, 6, 'Capital'); 
data.setValue(26, 7, 'VIALIDAD'); 
data.setValue(26, 8, 'En Ejecución'); 
data.setValue(27, 0, 'Construccion Obra Basica, Pavimento y Desagües Av. Santa Cruz '); 
data.setValue(27, 1, 2010); 
data.setValue(27, 2, 12); 
data.setValue(27, 3, 0.55); 
data.setValue(27, 4, 3442545.77); 
data.setValue(27, 5, 'Posadas'); 
data.setValue(27, 6, 'Capital'); 
data.setValue(27, 7, 'VIALIDAD'); 
data.setValue(27, 8, 'En Ejecución'); 
data.setValue(28, 0, 'Obra basica y Pavimento Ruta Pcial. Nº 5 '); 
data.setValue(28, 1, 2010); 
data.setValue(28, 2, 12); 
data.setValue(28, 3, 0.55); 
data.setValue(28, 4, 28407185.22); 
data.setValue(28, 5, 'Colonia Alberdi - Alvear - Oberá. Municipios de Colonia Alberdi, Alvear y Oberá - DPUERTO. Oberá'); 
data.setValue(28, 6, 'Oberá'); 
data.setValue(28, 7, 'VIALIDAD'); 
data.setValue(28, 8, 'En Ejecución'); 
data.setValue(29, 0, 'Construccion Obra Basica y Pavimento Ruta Prov. Nº 3 '); 
data.setValue(29, 1, 2010); 
data.setValue(29, 2, 24); 
data.setValue(29, 3, 0.41); 
data.setValue(29, 4, 55715787.04); 
data.setValue(29, 5, 'Cerro Azul. Municipios de Candelaria, Cerro Corá y Cerro Azul - DPUERTOs. Candelaria y Leandro N. Alem'); 
data.setValue(29, 6, 'Sin especificar'); 
data.setValue(29, 7, 'VIALIDAD'); 
data.setValue(29, 8, 'En Ejecución'); 
data.setValue(30, 0, 'Autodromo Ciudad de Obera '); 
data.setValue(30, 1, 2010); 
data.setValue(30, 2, 2); 
data.setValue(30, 3, 0.55); 
data.setValue(30, 4, 4592286.17); 
data.setValue(30, 5, 'Oberá'); 
data.setValue(30, 6, 'Oberá'); 
data.setValue(30, 7, 'VIALIDAD'); 
data.setValue(30, 8, 'En Ejecución'); 
data.setValue(31, 0, 'Construccion de Obra Basica y Pavimento Ruta Nac. Nº 101 '); 
data.setValue(31, 1, 2010); 
data.setValue(31, 2, 24); 
data.setValue(31, 3, 0.37); 
data.setValue(31, 4, 79899350.87); 
data.setValue(31, 5, ' Municipios Deseado y Piñalito Norte - DPUERTO. Gral. Manuel Belgrano.'); 
data.setValue(31, 6, 'Gral. M. Belgrano'); 
data.setValue(31, 7, 'VIALIDAD'); 
data.setValue(31, 8, 'En Ejecución'); 
data.setValue(32, 0, 'Construccion Obra Basica y Pavimento Ruta Nac. Nº 101 '); 
data.setValue(32, 1, 2010); 
data.setValue(32, 2, 21); 
data.setValue(32, 3, 0.43); 
data.setValue(32, 4, 22325159.74); 
data.setValue(32, 5, 'El Soberbio'); 
data.setValue(32, 6, 'Guaraní'); 
data.setValue(32, 7, 'VIALIDAD'); 
data.setValue(32, 8, 'En Ejecución'); 
data.setValue(33, 0, 'BARRIO IRRAZABAL '); 
data.setValue(33, 1, 2010); 
data.setValue(33, 2, 12); 
data.setValue(33, 3, 0.58); 
data.setValue(33, 4, 2653408.52); 
data.setValue(33, 5, 'San Pedro'); 
data.setValue(33, 6, 'San Pedro'); 
data.setValue(33, 7, 'UEP-PROMEBA'); 
data.setValue(33, 8, 'Ejecutado'); 


            var chart = new google.visualization.MotionChart(document.getElementById('chart_div')); 
            var options = {};
            options['state'] =
            '{"iconKeySettings":[],"stateVersion":5,"time":"notime","xAxisOption":"_NOTHING","playDuration":15,"iconType":"BUBBLE","sizeOption":"4","xZoomedDataMin":0,"xZoomedIn":false,"duration":{"multiplier":1,"timeUnit":"none"},"yZoomedDataMin":0,"xLambda":1,"colorOption":"_UNIQUE_COLOR","nonSelectedAlpha":0.4,"dimensions":{"iconDimensions":["dim0"]},"yZoomedIn":false,"yAxisOption":"_NOTHING","yLambda":1,"yZoomedDataMax":10,"showTrails":true,"xZoomedDataMax":10};';

            options['width'] = 900;
            options['height'] = 600;
            chart.draw(data, options);        
         } 
    </script>
    <div id="chart_div"></div>

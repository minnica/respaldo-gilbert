
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Grupo Gilbert</title>
    <link rel="shortcut icon" href="logo.ico">
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/logo.ico"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    <?php    
    $link = new PDO('mysql:host=localhost;dbname=gilbertm_prueba', 'gilbertm_root', 'Grupogilbert2020'); 
    ?>
</head>

<body>
<br>
<div style = "text-align: left">
                <a href="../../areas.php" align="left" class="btn btn-outline-dark"> MENÚ ÁREAS </a>
                  <a href="../../logout.php" class="btn btn-outline-danger"> CERRAR SESIÓN </a>
            </div>

    <div class="content">
 
        <div class="animated fadeIn">

            <div class="row">



                <div class="col-lg-4 col-md-4">
                    <p align="center">REPORTE MONTAJE DIARIO</p>
                    <div class="card text-white bg-flat-color-1">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib">
                                    <i class="ti-ruler-alt-2"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <h3 class="mb-0 fw-r" align="center">
                                            <?php foreach ($link->query('SELECT format(sum(peso_unitario),2)from tabla WHERE montaje= "SI" AND  DATE(fecha_montaje)= DATE(CURDATE())') as $row){ ?>
                                                <span class=""><?php echo $row['format(sum(peso_unitario),2)'] ?></span> Kg.
                                            <?php }?>
                                        </h3>
                                        <?php foreach ($link->query('select Date_format(now(),"%d %b %Y") as hoy;') as $row){ ?>                                            
                                        <p class="text-light mt-1 m-0"><?php echo $row['hoy'] ?> </p>
                                         <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-4 col-md-4">
                    <p align="center">REPORTE SEMANA ACTUAL</p>
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-3">
                                    <i class="pe-7s-graph2"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <?php foreach ($link->query('SELECT IFNULL (FORMAT(SUM(peso_unitario),2),0) AS montaje FROM tabla WHERE montaje="SI" AND fecha_montaje BETWEEN DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY) AND DATE_ADD(DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY),INTERVAL 6 DAY)') as $row){ ?> 
                                            <div class="stat-text"><span class=""><?php echo $row['montaje'] ?></span> Kg.</div>
                                        <?php }?>
                                        <!--<div class="stat-heading">AEROPUERTO</div>-->
                                        <?php foreach ($link->query('SELECT CURDATE() as hoy, DATE_FORMAT(DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY),"%d/%b/%Y") as primero, DATE_FORMAT(DATE_ADD(DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY),INTERVAL 6 DAY),"%d/%b/%Y") as ultimo') as $row){ ?>
                                            <div class="stat-heading"><strong><?php echo $row['primero'] ?></strong> al <strong><?php echo $row['ultimo'] ?></strong> </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-md-4">
                    <p align="center">REPORTE SEMANAL ANTERIOR</p>
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-4">
                                    <i class="pe-7s-plane"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <?php foreach ($link->query('SELECT IFNULL (FORMAT(SUM(peso_unitario),2),0) AS suma FROM tabla WHERE fecha_montaje BETWEEN DATE_SUB(DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY),INTERVAL 7 DAY) AND DATE_SUB(DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY),INTERVAL 1 DAY)') as $row){ ?>                                          
                                            <div class="stat-text"><span class=""><?php echo $row['suma'] ?></span> Kg.</div>
                                            <!--<div class="stat-heading">AEROPUERTO</div>-->
                                        <?php }?>
                                        <div class="stat-heading"></div>
                                        <?php foreach ($link->query('SELECT DATE_FORMAT(DATE_SUB(DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY),INTERVAL 7 DAY),"%d/%b/%Y") as InicioSemanaAnterior, DATE_FORMAT(DATE_SUB(DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY),INTERVAL 1 DAY),"%d/%b/%Y") as FinSemanaAnterior, CURDATE() as hoy') as $row){ ?>
                                            <div class="stat-heading"> <strong><?php echo $row['InicioSemanaAnterior'] ?></strong> al  <strong><?php echo $row['FinSemanaAnterior'] ?></strong></div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders -->
            <div align="center">
                <div class="orders">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">HISTORIAL DE MONTAJE </h4>
                                </div>
                                <div class="card-body--">

                                    <div class="container">
                                        <table class="table table-bordered">
                                            <thead align="center">
                                                <tr>
                                                    <th>FECHA</th>
                                                    <th>MONTAJE</th>
                                                </tr>
                                            </thead>
                                            <tbody align="center">
                                                <?php foreach ($link->query("SELECT Date_format(fecha_montaje,'%d %b %Y') as fecha, FORMAT(SUM(peso_unitario),2) as montaje FROM tabla WHERE montaje='SI' GROUP BY fecha DESC ORDER BY fecha_montaje DESC") as $row){ ?> 
                                                    <tr>
                                                        <td><?php echo $row['fecha'] ?></td>
                                                        <td><span class=""><?php echo $row['montaje']?></span></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div> <!-- /.card -->
                        </div>  <!-- /.col-lg-8 -->

                        <!-- /.col-md-4 -->
                    </div>
                </div>
            </div>

            <div class="orders">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title" align="center"></h4>
                                <!--<canvas id="team-chart"></canvas>-->
                                <canvas id="miGrafico3"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<!-- html comment 

<div class="row">
<div class="col-lg-8">
<div class="card-body">
<canvas id="TrafficChart"></canvas>
<div id="traffic-chart" class="traffic-chart"></div>
</div>
</div>

</div> --><!-- /.row -->                

</div>
<!-- /.content -->
<div class="clearfix"></div>
<!-- Footer -->
</div>
<!-- /#right-panel -->


<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>

<!--  Chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

<!--Chartist Chart-->
<script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
<script src="assets/js/init/weather-init.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
<script src="assets/js/init/fullcalendar-init.js"></script>
<script src="assets/js/init/chartjs-init.js"></script>
<script type="text/javascript" src="js/datos.js"></script>
</body>
</html>

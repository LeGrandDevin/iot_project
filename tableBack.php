
<div class="tables" id="tables">
    <?php
    $conn = mysqli_connect("185.224.138.133", "u928306449_groupe_quatre","KeyceGroupe4","u928306449_groupe_quatre" );
    $sql = mysqli_query($conn, "SELECT * FROM captorData" );
    echo '<table class="table-content" id="table-content">';
    echo '<thead><tr class="table-header">'.'<td class="header-item">idcaptorData</td>'.'<td class="header-item">humidity</td>'.'<td class="header-item">temperature</td>'.'<td class="header-item">date</td></thead>';
    echo '<tbody>';
    while($data = mysqli_fetch_array($sql))
    {
        echo '<tr class="table-row">'.'<td class="table-data">'.$data['idcaptorData'].'</td>'.'<td class="table-data">'.$data['humidity'].'</td>'.'<td class="table-data">'.$data['temperature'].'</td>'.'<td class="table-data">'.$data['date'].'</td>'.'</tr>'/*."<br/>"*/ ;
    }
    echo '</tbody></table>';
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
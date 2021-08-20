<?php
require("conn.php");

$rows = $db->query("Select * from categories order by sira asc")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Hello, world!</title>
    <style>
        /*  Kendine has sınıfları var ve buradan özelleştirebiliyoruz. */
        .ui-sortable-placeholder {
            outline: 2px solid red;
            visibility: visible !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <table class="table table-warning table-striped">
                <thead>
                    <tr>
                        <th scope="col">Kategori Adı</th>
                        <th scope="col">Sıra</th>
                    </tr>
                </thead>
                <tbody id="sortable">
                    <?php
                    foreach ($rows as $row) {
                    ?>

                        <tr id="sira-<?= $row['id'] ?>">
                            <td><?= $row['category_name'] ?></td>
                            <td><?= $row['sira'] + 1 ?></td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $('#sortable').sortable({
            // axis özelliği hareketin hangi koordinatta olacağını belirler.
            axis: "y",
            // containment hareketin sınırını belirler 
            containment: "parent",
            cursor: "pointer",
            update: function(event, ui) {
                var siralama = $(this).sortable("serialize");
                siralamaGuncelle(siralama);
                siralamaTextUpdate();
            }
        });

        // Sıralama güncelle fonksiyonu
        function siralamaGuncelle(data) {
            $.ajax({
                url: "sortable.php",
                method: "POST",
                data: data,
                success: function(sonuc) {}
            })
        }

        // Tabloda bulunan sıralama satırlarının da güncellenmesi için bu fonksiyonu kullanıyoruz.
        function siralamaTextUpdate(){
            $("#sortable tr").each(function(index){
                $(this).find("td:last-child").html(index+1);
            })
        }
    </script>
</body>

</html>
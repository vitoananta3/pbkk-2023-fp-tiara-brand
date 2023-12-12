<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>JustBookStore <?= isset($pageTitle) ? $pageTitle : '' ?></title> -->
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>css/style.css?v=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>css/my-style.css">
    <link rel="shortcut icon" type="image/png" href="/bagicon.png">
</head>

<body class="bg-[#E5E9F0]">
    <?= $this->renderSection('content') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script>
        function previewImg() {
            const imgPreview = document.querySelector('.img-preview');

            const coverFile = new FileReader();
            coverFile.readAsDataURL(cover.files[0]);

            coverFile.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
    <script>
        const alert = document.getElementById("alert-3");
        if (alert) {
            setTimeout(function() {
                alert.classList.add("hide");
                setTimeout(function() {
                    alert.remove();
                }, 1000);
            }, 2000);
        }
    </script>
</body>

</html>
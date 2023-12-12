<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>JustBookStore <?= isset($pageTitle) ? $pageTitle : '' ?></title> -->
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>css/style.css?v=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>css/my-style.css">
    <!-- <link rel="shortcut icon" type="image/png" href="/bookicon.png"> -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
    </svg>
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
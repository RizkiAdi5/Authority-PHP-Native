<?php

include "conection.php";
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Mian Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');

        h1 {
            font-family: "Pacifico", cursive;
        }

        .text-slide {
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .carousel {
            display: flex;
            animation: slide 30s linear infinite;

        }

        @keyframes slide {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }

     
        }

        .infinite-text {
            white-space: nowrap;
            font-size: 24px;    
            margin: 0;
            padding: 0;
            line-height: 1.5;
        }
    </style>
    <!-- Bootstrap CSS v5.3.2 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <script>
        function confirmLogout(event) {
            event.preventDefault(); // Mencegah aksi default tombol logout

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success mx-3",
                    cancelButton: "btn btn-danger mx-3"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Are you sure you want to exit?",
                text: "You won't be able to get this back!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, exit!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire({
                        title: "Logged out!",
                        text: "You have successfully exited.",
                        icon: "success"
                    }).then(() => {
                        window.location.href = event.target.href;
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: "Canceled",
                        text: "The logout action has been canceled.",
                        icon: "error"
                    });
                }
            });
        }

        // carousel text
        document.addEventListener("DOMContentLoaded", function() {
            const carousel = document.querySelector('.carousel');

            const firstClone = carousel.children[0].cloneNode(true);
            const secondClone = carousel.children[1].cloneNode(true);

            carousel.appendChild(firstClone);
            carousel.appendChild(secondClone);

            const itemsCount = carousel.children.length;
            const itemWidth = carousel.children[0].offsetWidth;


            carousel.style.width = `${itemWidth * itemsCount}px`;

            let currentIndex = 0;

            setInterval(() => {
                currentIndex++;
                if (currentIndex >= itemsCount / 2) {
                    currentIndex = 0;
                    carousel.style.transition = 'none'; 
                    carousel.style.transform = `translateX(0)`;
                    setTimeout(() => {
                        carousel.style.transition = 'transform 10s linear'; 
                        carousel.style.transform = `translateX(-${itemWidth * (itemsCount / 2)}px)`;
                    }, 20);
                } else {
                    carousel.style.transform = `translateX(-${itemWidth * currentIndex}px)`;
                }
            }, 500); //interval
        });
    </script>

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>

<body>
    <!-- loader -->
    <div class="loader"></div>
    <main class="mt-4">
        <div class="text-slide d-flex gap-3">
            <div class="carousel">
                <ul class="list-unstyled d-flex gap-3">
                    <?php for ($i = 0; $i < 15; $i++): ?>
                        <li>
                            <h1 class="infinite-text">
                                <span class="text-primary"><?php echo htmlspecialchars($_SESSION['username']); ?></span> is here!!!
                            </h1>
                        </li>
                    <?php endfor; ?>
                </ul>
                <ul class="list-unstyled d-flex gap-3 mx-3">
                    <?php for ($i = 0; $i < 15; $i++): ?>
                        <li>
                            <h1 class="infinite-text">
                                <span class="text-primary"><?php echo htmlspecialchars($_SESSION['username']); ?></span> is here!!!
                            </h1>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>

        <hr>


    </main>

    <footer class="text-center mt-4">
        <a href="logout.php" class="btn btn-danger" onclick="confirmLogout(event)">Logout</a>
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>
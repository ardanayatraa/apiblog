<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs : API Documentation</title>
    <script src="https://cdn.jsdelivr.net/npm/redoc@next/bundles/redoc.standalone.js"></script>
</head>

<body>
    <div id="redoc-container"></div>
    <script>
        // Memanggil ReDoc secara manual
        Redoc.init(
            '{{ asset('openapi.json') }}', // URL ke file OpenAPI JSON
            {
                scrollYOffset: 50, // Offset untuk scroll
                theme: {
                    colors: {
                        primary: {
                            main: '#5c67f2' // Ubah warna tema utama
                        }
                    }
                }
            },
            document.getElementById('redoc-container') // Elemen target untuk render ReDoc
        );
    </script>
</body>

</html>

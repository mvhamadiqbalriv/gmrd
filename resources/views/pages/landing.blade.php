<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GMRD</title>
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap"
    rel="stylesheet" />
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <script>
    tailwind.config = {
        darkMode: "class",
        theme: {
        fontFamily: {
            sans: ["Roboto", "sans-serif"],
            body: ["Roboto", "sans-serif"],
            mono: ["ui-monospace", "monospace"],
        },
        },
        corePlugins: {
        preflight: false,
        },
    };
    </script>
</head>
<body>
    <!-- Jumbotron -->
<div
class="relative overflow-hidden rounded-lg bg-cover bg-no-repeat p-12 text-center"
style="background-image: url('https://images.unsplash.com/photo-1442544213729-6a15f1611937?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1932&q=80'); height: 100vh">
<div
  class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-fixed"
  style="background-color: rgba(0, 0, 0, 0.6)">
  <div class="flex h-full items-center justify-center">
    <div class="text-white">
      <h2 class="mb-4 text-4xl font-semibold">GOTONG ROYONG MEMBANGUN DESA</h2>
      <h4 class="mb-6 text-xl">Hasil kolaborasi Pemerintah Kabupaten Sumedang dengan LLDIKTI Wilayah 4</h4>
      <a href="{{route('login')}}"
        type="button"
        class="rounded border-2 border-neutral-50 px-7 pb-[8px] pt-[10px] text-sm font-medium uppercase leading-normal text-neutral-50 transition duration-150 ease-in-out hover:border-neutral-100 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-neutral-100 focus:border-neutral-100 focus:text-neutral-100 focus:outline-none focus:ring-0 active:border-neutral-200 active:text-neutral-200 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
        data-te-ripple-init
        data-te-ripple-color="light">
        Login
      </a>
    </div>
  </div>
</div>
</div>
<!-- Jumbotron -->
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</body>
</html>

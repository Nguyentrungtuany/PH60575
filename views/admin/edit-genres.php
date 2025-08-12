  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Argon Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="./assets/css/argon-dashboard-tailwind.css?v=1.0.1" rel="stylesheet" />
  </head>

  <body class="m-0 font-sans text-base antialiased leading-default text-slate-500">
    <!-- Nền xanh full màn -->
    <div class="fixed inset-0 w-full h-full bg-blue-500 z-0"></div>

    <!-- Main content center -->
    <main class="relative z-10 flex items-center justify-center min-h-screen">
      <div class="w-full max-w-5xl px-4">
        <div class="flex flex-col bg-white shadow-xl rounded-2xl">

          <!-- Tiêu đề -->
          <div class="p-6 pb-0 mb-0 border-b border-gray-200">
            <h6 class="text-lg font-semibold text-gray-700">Authors table</h6>
          </div>

          <!-- Form chỉnh sửa -->
          <form action="<?= BASE_URL_ADMIN . '?act=update-genres&id=' . $genre['id'] ?>" method="POST" enctype="multipart/form-data">
            <div class="flex-auto px-4 pt-4 pb-6">
              <div class="overflow-x-auto w-full">
                <table class="table-auto w-full text-slate-500 border-collapse">
                  <tbody class="text-sm text-gray-700">


                  
                  

                    <tr>
                      <td class="px-6 py-3 font-bold bg-gray-100">Danh mục</td>
                      <td class="px-6 py-3">
                          <input class=" text-sm text-slate-600" 
                                name="name" value="<?= htmlspecialchars($genre['name'] ?? '') ?>" />
                      </td>
                    </tr>
                  </tbody>
                </table>

                <!-- Nút cập nhật -->
                <div class="px-6 mt-6 text-right">
                  <button class="bg-gradient-to-tl from-blue-500 to-purple-400 px-4 py-2 rounded-full text-xs font-bold uppercase text-white" type="submit">
                    Cập nhật
                  </button>
                </div>

              </div>
            </div>
          </form>

        </div>
      </div>
    </main>
  </body>
  </html>

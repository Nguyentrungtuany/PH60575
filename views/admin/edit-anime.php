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
        <form action="<?= BASE_URL_ADMIN . '?act=update-anime&id=' . $anime['id'] ?>" method="POST" enctype="multipart/form-data">
          <div class="flex-auto px-4 pt-4 pb-6">
            <div class="overflow-x-auto w-full">
              <table class="table-auto w-full text-slate-500 border-collapse">
                <tbody class="text-sm text-gray-700">

                  <!-- Ảnh đại diện -->
                  <tr>
                    <td class="px-6 py-3 font-bold bg-gray-100">Ảnh</td>
                    <td class="px-6 py-3">
                      <img src="<?php echo BASE_URL . $anime['poster_url'] ?>"  alt="poster_url" class="w-9 h-9 rounded-xl mr-4" />
                      <input type="file" name="poster_url">

                    </td>
                  </tr>

                  <!-- Tên và Gmail -->
                  <tr>
                    <td class="px-6 py-3 font-bold bg-gray-100">Tên (Tiêu đề)</td>
                    <td class="px-6 py-3">
                      
                        <input class="" 
                               name="title" value="<?= htmlspecialchars($anime['title'] ?? '') ?>" />
                        <input class=" text-sm text-slate-600" 
                               name="description" value="<?= htmlspecialchars($anime['description'] ?? '') ?>" />
                      </div>
                    </td>
                  </tr>

                  <!-- Chức vụ và mật khẩu -->
                  <tr>
                    <td class="px-6 py-3 font-bold bg-gray-100">Năm (Link trailer)</td>
                    <td class="px-6 py-3">
                      
                        <input class="" 
                               name="release_year" value="<?= htmlspecialchars($anime['release_year'] ?? '') ?>" />
                        <input class=" text-sm text-slate-600" 
                               name="trailer_url" value="<?= htmlspecialchars($anime['trailer_url'] ?? '') ?>" />
                      </div>
                    </td>
                  </tr>

                  <!-- Thời gian tạo -->
                  <tr>
                    <td class="px-6 py-3 font-bold bg-gray-100">Tổng số tập (số tập đã phát hành)</td>
                    <td class="px-6 py-3">
                      
                        <input class="" 
                               name="episodes_total" value="<?= htmlspecialchars($anime['episodes_total'] ?? '') ?>" />
                        <input class=" text-sm text-slate-600" 
                               name="episodes_released" value="<?= htmlspecialchars($anime['episodes_released'] ?? '') ?>" />
                    </td>
                  </tr>
                  <!-- <tr>
                    <td class="px-6 py-3 font-bold bg-gray-100">Danh mục</td>
                    <td class="px-6 py-3">
                        <input class="" 
                               name="episodes_total" value="" />
                    </td>
                  </tr> -->
                  <tr>
    <td class="px-6 py-3 font-bold bg-gray-100">Danh mục</td>
<td class="px-6 py-3">
    <!-- Hiển thị tên thể loại hiện tại -->
    <span class="block mb-2 text-sm text-gray-600">
        <?= htmlspecialchars($anime['genre_name'] ?? 'Chưa có thể loại') ?>
    </span>

    <!-- Input ẩn gửi anime_id -->
    <input type="hidden" name="anime_id" value="<?= htmlspecialchars($anime['id'] ?? '') ?>">
<select name="genre_id" ...>
    <option value="" disabled <?= empty($anime['genre_id']) ? 'selected' : '' ?>>Chọn thể loại</option>
    <?php foreach ($genres as $genre): ?>
        <option value="<?= $genre['id'] ?>" <?= ($anime['genre_id'] ?? '') == $genre['id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($genre['name']) ?>
        </option>
    <?php endforeach; ?>
</select>

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

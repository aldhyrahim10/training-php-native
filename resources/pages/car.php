<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Cars</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Cars</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Cars List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalAdd">
              Add Data
            </button>
            <table class="myTable table table-bordered table-hover">
              <thead class="text-center">
                <tr>
                  <th style="width: 10%">No</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Capacity</th>
                  <th>Price/day</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="carTableBody">
                <?php foreach($cars as $car): ?>
                <tr>
                  <td><?= $car['id'] ?></td>
                  <td><?= $car['name'] ?></td>
                  <td><?= $car['category_name'] ?></td>
                  <td><?= $car['capacity'] ?></td>
                  <td>Rp <?= number_format($car['price'], 0, ',', '.') ?></td>
                  <td class="text-center">

                    <div class="btn btn-success btn-edit" data-toggle="modal" data-target="#modalEdit" data-id="<?= $car['id'] ?>">
                      <i class="fas fa-pencil-alt"></i>
                    </div>
                    <div class="btn btn-danger btn-delete" data-id="<?= $car['id'] ?>">
                      <i class="fas fa-trash-alt"></i>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>

<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="modalAddLabel">Add Data</h2>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <form id="formAddCar" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Car Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter Car Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Car Category</label>
                                <select name="car_category_id" id="car_category_id" class="form-control">
                                    <option value="">--Select Category--</option>
                                    <?php foreach($categories as $category): ?>
                                      <option value="<?= $category["id"] ?>"><?= $category["category_name"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Capacity</label>
                                <input type="number" class="form-control" name="capacity" id="capacity"
                                    placeholder="Enter Capacity">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Price/day</label>
                                <input type="number" class="form-control" name="price" id="price"
                                    placeholder="Enter Price/day">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCloseModalAdd" class="btn btn-secondary"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="modalEditLabel">Edit Data</h2>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <form id="formEditCar" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Cars Name</label>
                                <input type="hidden" name="hdnCarID" id="hdnCarID" value="">
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter Car Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Car Category</label>
                                <select name="car_category_id" id="car_category_id" class="form-control">
                                    <option value="">--Select Category--</option>
                                    <?php foreach($categories as $category): ?>
                                      <option value="<?= $category["id"] ?>"><?= $category["category_name"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Capacity</label>
                                <input type="number" class="form-control" name="capacity" id="capacity"
                                    placeholder="Enter Capacity">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Price/day</label>
                                <input type="number" class="form-control" name="price" id="price"
                                    placeholder="Enter Price/day">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCloseModalEdit" class="btn btn-secondary"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#formAddCar").on("submit", function (e) {
            e.preventDefault();

            $.ajax({
                url: "/cars-rent/car",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (res) {
                    if (res.status === "success") {
                        alert("Data berhasil ditambahkan")
                        location.reload();
                    } else {
                        alert(res.message);
                    }
                },
                error: function () {
                    alert("Terjadi kesalahan server.");
                }
            });
        });

        $(".btn-edit").click(function () {
            var id = $(this).data("id");

            $.ajax({
                url: "car/show", // sudah di-handle .htaccess
                method: "GET",
                data: {
                    id: id
                },
                dataType: "json",
                success: function (res) {
                    if (res.status === "success") {
                        var formEditContent = $("#formEditCar");

                        formEditContent.find("#hdnCarID").val(res.data.car_id);
                        formEditContent.find("#name").val(res.data.name);
                        formEditContent.find("#car_category_id").val(res.data.car_category_id);
                        formEditContent.find("#capacity").val(res.data.capacity);
                        formEditContent.find("#price").val(res.data.price);

                    } else {
                        alert(res.message);
                    }
                },
                error: function () {
                    alert("Gagal ambil data dari server");
                }
            });
        });

        $("#formEditCar").on("submit", function (e) {
            e.preventDefault();

            $.ajax({
                url: "car/update",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (res) {
                    if (res.status === "success") {
                        alert("Update berhasil");
                        location.reload(); // reload table
                    } else {
                        alert(res.message);
                    }
                }
            });
        });

        $(".btn-delete").click(function () {
            let id = $(this).data('id');

            if (confirm("Yakin ingin menghapus data ini?")) {
                $.ajax({
                    url: 'car/delete',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (response) {
                        let res = JSON.parse(response);
                        if (res.status === 'success') {
                            alert("Data berhasil dihapus");
                            location.reload(); // reload halaman tabel
                        } else {
                            alert("Gagal menghapus: " + res.message);
                        }
                    }
                });
            }
        });

    });
</script>
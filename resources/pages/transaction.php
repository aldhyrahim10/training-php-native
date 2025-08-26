<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Transactions</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Transactions</li>
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
                        <h3 class="card-title">Transactions List</h3>
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
                                    <th>Customer Name</th>
                                    <th>Car</th>
                                    <th>For Days</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody id="transactionTableBody">
                                <?php foreach($transactions as $item): ?>
                                    <tr>
                                        <td><?= $item['transaction_id'] ?></td>
                                        <td><?= $item['customer_name'] ?></td>
                                        <td><?= $item['car_name'] ?></td>
                                        <td><?= $item['days'] ?></td>
                                        <td>Rp <?= number_format($item['total_price'], 0, ',', '.') ?></td>
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
            <form id="formAddTransaction" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" name="customer_name" id="customer_name"
                                    placeholder="Enter Customer Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Car</label>
                                <select name="car_id" id="car_id" class="form-control">
                                    <option value="">--Select Car--</option>
                                    <?php foreach($cars as $car): ?>
                                      <option value="<?= $car["id"] ?>"><?= $car["name"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>For Day</label>
                                <input type="number" class="form-control" name="days" id="days"
                                    placeholder="Enter For Days">
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

<script>
    $(document).ready(function () {
        $("#formAddTransaction").on("submit", function (e) {
            e.preventDefault();

            $.ajax({
                url: "/cars-rent/transaction",
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

        

    });
</script>

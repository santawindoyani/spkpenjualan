<div class="page-header">
    <h1>Halaman Olah Brand</h1>
</div>
<div class="col-lg-12">
    <?php
    $msg = $this->session->flashdata('message');
    if (isset($msg)) {
    ?>
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
            <?php echo $msg; ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php
    }
    ?>
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">List Brand</div>
            <div class="panel-content">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-6">Brand</th>
                                <th class="col-md-5 ">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if (isset($brand)) {
                                if (count($brand) == 0) {
                                    echo '<tr><td colspan="3" class="text-center"><h3>No Data Input</h3></td></tr>';
                                }
                                foreach ($brand as $item) {
                            ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $item->brand ?></td>                                    
                                        <td>
                                            <!-- Indicates a dangerous or potentially negative action -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <a href="<?php echo site_url('brand/tambah') ?>" type="button" class="btn btn-primary">Tambah
                Brand</a>
        </div>

    </div>

</div>



<div class="modal fade" id="modalDelete" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi hapus data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <p>Apakah anda yakin menghapus data ini ? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="hapus_brand(<?php echo $item->kdbrand; ?>)">
                    Hapus
                </button>
                    </div>
                  </div>
                </div>
              </div>
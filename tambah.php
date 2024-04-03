<div class="page-header">
    <h1>Tambah Brand</h1>
</div>
<div class="col-md-12">
    <?php echo form_open('', array('enctype' => 'multipart/form-data')) ?>
    <div class="row">
        <div class="errors">
            <?php
            $errors = $this->session->flashdata('errors');
            if (isset($errors)) {
                foreach ($errors as $error) {
            ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <?php echo $error; ?>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-inline">
                    <div class="form-group">
                        <label for="brand">Nama Brand</label>
                        <input name="brand" type="text" class="form-control" id="brand" value="<?php echo isset($nilaibrand[0]->brand) ? $nilaibrand[0]->brand : '' ?>" placeholder="Brand Barang">
                        <br>
                        <label for="model">Model</label>
                        <input name="model" placeholder="Model Barang" class="form-control" type="text" required />
                        <br>
                        <label for="size">Size</label>
                        <input name="size" placeholder="Size Barang" class="form-control" type="text" required />
                        <br>
                        <label for="produk">Produk</label>
                        <input name="produk" placeholder="Produk Barang" class="form-control" type="text" required />
                        <br>
                        <label for="harga">Harga</label>
                        <input name="harga" placeholder="Harga Barang" class="form-control" type="text" required />
                        <br>


                    </div>
                </div>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-striped">
                <br>
                <tr>
                    <th class="col-md-3">Kriteria</th>
                    <th colspan="5" class="text-center col-md-9">Nilai</th>
                </tr>
                <?php
                foreach ($dataView as $item) {
                ?>
                    <tr>
                        <td><?php echo $item['nama']; ?></td>
                        <?php
                        $no = 1;
                        foreach ($item['data'] as $dataItem) {

                        ?>
                            <td>
                                <input type="radio" name="nilai[<?php echo $dataItem->kdKriteria ?>]" value="<?php echo $dataItem->value ?>" <?php
                                                                                                                                                if (isset($nilaibrand)) {
                                                                                                                                                    foreach ($nilaibrand as $item => $value) {
                                                                                                                                                        if ($value->kdKriteria == $dataItem->kdKriteria) {
                                                                                                                                                            if ($value->nilai ==  $dataItem->value) {
                                                                                                                                                ?> checked="checked" <?php
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                            }
                                                                                                                                                        } else {
                                                                                                                                                            if ($no == 3) {
                                                                                                                                                                        ?> checked="checked" <?php
                                                                                                                                                                                            }
                                                                                                                                                                                        }
                                                                                                                                                                                                ?> /> <?php echo $dataItem->subKriteria;
                                                                                                                                                                                                        $no++;
                                                                                                                                                                                                        ?>
                            </td>

                    <?php
                        }
                        echo '</tr>';
                    }
                    ?>

            </table>
        </div>

        <div class="pull-right">
            <div class="col-md-12">
                <button class="btn btn-primary" type="submit">Save</button>
                <a class="btn btn-danger" href="<?php site_url('brand') ?>" role="button">Batal</a>

            </div>
        </div>
    </div>
    <?php echo form_close() ?>
</div>
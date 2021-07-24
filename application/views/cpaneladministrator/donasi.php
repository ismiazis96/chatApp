        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Donasi</h2><a href="#" data-toggle="modal" data-target="#tambah" data-backdrop="static" data-keyboard="false" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Tambah</a>

                  <!-- Modal -->
                          <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Donasi</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form action="<?php echo base_url('cpaneladministrator/tambahdonasi'); ?>" method='post' enctype="multipart/form-data">
                                      
                                      <div class="form-group">
                                        <label>Bank Transfer</label>
                                        <select name="bank" class="form-control" required>
                                          <option value="">Pilih Bank</option>
                                          <?php $no=1; foreach($bank->result() as $key) : ?>
                                          <option value="<?php echo $key->idBank; ?>"><?php echo $key->bank." - ".$key->norek." (a.n ".$key->nama.")"?></option>
                                        <?php endforeach; ?>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label for="nama">Nama</label>
                                      <input type="text" name="nama" class="form-control" required>
                                    </div>


                                    <div class="form-group">
                                      <label for="email">E-Mail</label>
                                      <input type="email" name="email" class="form-control" required>
                                    </div>


                                    <div class="form-group">
                                      <label for="jumlah">jumlah</label>
                                      <input type="text" name="jumlah" class="form-control" onkeypress="return hanyaAngka(event)" required>
                                    </div>

                                    <script>
                                      function hanyaAngka(evt) {
                                        var charCode = (evt.which) ? evt.which : event.keyCode
                                        if (charCode > 31 && (charCode < 48 || charCode > 57))

                                          return false;
                                        return true;
                                      }
                                    </script>

                                    <div class="form-group">
                                      <label for="bukti_transfer">Bukti Tf</label>
                                      <input type="file" name="bukti_transfer" class="form-control" accept="image/png,image/gif,image/jpeg,image/jpg">
                                    </div>

                                    <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="anonim" value="anonim"> Samarkan Nama
                                    </label>
                                  </div>

                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">
                    <div class="col-sm-12">
                     <?php if($this->session->flashdata('alert')){ ?>  
                       <div class="alert alert-danger alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Gagal</strong> <?php echo $this->session->flashdata('alert'); ?>
                      </div>
                    <?php } ?>

                    <?php if($this->session->flashdata('sukses')){ ?>  
                     <div class="alert alert-success alert-dismissible " role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                      </button>
                      <strong>Berhasil</strong> <?php echo $this->session->flashdata('sukses'); ?>
                    </div>
                  <?php } ?>
                  <div class="card-box table-responsive">


                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th>E-Mail</th>
                      <th>Bank Tujuan</th>
                      <th>Jumlah</th>
                      <th>Bukti</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach($donasi->result() as $key) { ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo date('d F Y h:i:s', strtotime($key->tanggal)); ?></td>
                      <td><?php echo $key->namaPublish." (".$key->nama.")" ?></td>
                      <td><?php echo $key->email; ?></td>
                      <td><?php echo $key->bank; ?></td>
                      <td><?php echo "Rp " . number_format($key->jumlah,2,',','.'); ?></td>
                      <td><?php if(!empty($key->bukti)){ ?> <img src="<?php echo base_url('template/images/buktitransfer/'.$key->bukti) ?>" width="50"> <?php } ?></td>
                      <td><?php if($key->status=="valid"){ echo "<span class='badge badge-success'>Valid</span>"; }elseif($key->status=="tidak valid"){echo "<span class='badge badge-warning'>Tidak Valid</span>";}  ?></td>
                      <td><a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#valid<?php echo $key->idDonasi ?>" data-backdrop="static" data-keyboard="false">Edit</a></td>
                          <!-- Modal -->
                          <div class="modal fade" id="valid<?php echo $key->idDonasi; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalCenterTitle">Validasi Donasi</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form action="<?php echo base_url('cpaneladministrator/prosesvalidasi2') ?>" method="post">
                                    <input type="hidden" name="idDonasi" value="<?php echo $key->idDonasi ?>">
                                    <input type="hidden" name="bukti" value="<?php echo $key->bukti ?>">

                                     <div class="form-group">
                                        <label>Bank Transfer</label>
                                        <select name="bank" class="form-control" required>
                                          <option value="<?php echo $key->idBank; ?>"><?php echo $key->bank." - ".$key->norek." (a.n ".$key->nama.")"?></option>
                                          <?php foreach($bank->result() as $key1) { ?>
                                          <option value="<?php echo $key1->idBank; ?>"><?php echo $key1->bank." - ".$key1->norek." (a.n ".$key1->nama.")"?></option>
                                          <?php } ?>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label for="nama">Nama</label>
                                      <input type="text" name="nama" class="form-control" value="<?php echo $key->nama; ?>" required>
                                    </div>


                                    <div class="form-group">
                                      <label for="email">E-Mail</label>
                                      <input type="email" name="email" class="form-control" value="<?php echo $key->email; ?>" required>
                                    </div>


                                    <div class="form-group">
                                      <label for="jumlah">jumlah</label>
                                      <input type="text" name="jumlah" class="form-control" onkeypress="return hanyaAngka(event)" value="<?php echo $key->jumlah; ?>" required>
                                    </div>

                                    <script>
                                      function hanyaAngka(evt) {
                                        var charCode = (evt.which) ? evt.which : event.keyCode
                                        if (charCode > 31 && (charCode < 48 || charCode > 57))

                                          return false;
                                        return true;
                                      }
                                    </script>

                                    <div class="form-group">
                                      <label for="bukti_transfer">Bukti Tf</label>
                                      <input type="file" name="bukti_transfer" class="form-control" accept="image/png,image/gif,image/jpeg,image/jpg">
                                      <?php  
                                        if(!empty($key->bukti)){ ?>
                                          <img src="<?php echo base_url('template/images/buktitransfer/'.$key->bukti) ?>" width="50">
                                        <?php } ?>
                                      
                                    </div>

                                    <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="anonim" value="anonim" <?php if($key->namaPublish=="Nama Disamarkan"){ echo "checked"; } ?> > Samarkan Nama
                                    </label>
                                  </div>
                                    <div class="form-group">
                                      <label>Validasi</label>
                                      <select name="valid" class="form-control" required>
                                        <option value="<?php echo $key->status; ?>"><?php echo $key->status; ?></option>
                                        <option value="valid">Valid</option>
                                        <option value="tidak valid">Tidak Valid</option>
                                      </select>
                                    </div>                                    
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Selesai</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
        <!-- /page content -->
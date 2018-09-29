                      <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document" id="">
                          <form role="form" action="" name="frm" id="formulario">
                            <div class="modal-content">
                              <div class="modal-header">
                                {{ csrf_field() }} {{ method_field('POST') }}
                                <h3 class="modal-title">Usuarios</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              </div>

                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Nombres</label>
                                      <input name="name" class="form-control input-xs" id="name" required>
                                      <span class="help-block with-errors"></span>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Email</label>
                                      <input type="email" name="email" class="form-control" id="email" required>
                                      <span class="help-block with-errors"></span>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Password</label>
                                      <input name="password" class="form-control"  type="password" id="password" required>
                                      <span class="help-block with-errors"></span>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Confirmar Password</label>
                                      <input name="password1" class="form-control"  type="password" id="password1" required>
                                      <span class="help-block with-errors"></span>
                                    </div>
                                  </div>


                                </div>
                              </div>
                              <div class="modal-footer">
                                <input type="hidden" name="id" id="id">
                                <input type="submit" name="btnsend" class="btn btn-primary" id="btnsend"> 
                                <input type='button' name='cerrar'  class="btn btn-danger"  id="cerrar" data-dismiss="modal">
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>

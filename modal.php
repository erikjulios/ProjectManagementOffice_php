<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store.data.document') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group mb-3">
                        <label for="exampleInputBorder"><code>Semester</code></label>
                        <div class="input-group">
                            <select class="custom-select form-control-border" id="exampleSelectBorder" name="semester"
                                placeholder="Semester">
                                <option value="none" selected disabled hidden>Pilih Semester</option>          
                                    <option value="genap" id="genap"> Genap</option>
                                    <option value="ganjil" id="ganjil"> Ganjil</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputBorder"><code>Tahun ajaran</code></label>
                        <div class="input-group">
                            <select class="custom-select form-control-border" id="exampleSelectBorder" name="tahun"
                                placeholder="Tahun ajaran">
                                <option value="none" selected disabled hidden>Pilih Tahun Ajaran</option>
                                if
                                @for ($i = 2022; $i < 2030; $i++)
                                    <option value={{$i."/".$i+1}}> {{$i."/".$i+1}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputBorder"><code>Fakultas</code></label>
                        <div class="input-group">
                            <select class="custom-select form-control-border" id="exampleSelectBorder" name="faculty_id"
                                placeholder="Faculty">
                                <option value="none" selected disabled hidden>Pilih Fakultas</option>
                                @for ($i = 1; $i < count($DataFaculty); $i++)
                                    <option value={{ $DataFaculty[$i]->id_faculty }}>
                                        {{ $DataFaculty[$i]->faculty_name }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputBorder"><code>Validator</code></label>
                        <div class="input-group">
                            <select class="custom-select form-control-border" id="exampleSelectBorder"
                                name="validate_by" placeholder="Validator">
                                <option value="none" selected disabled hidden>Pilih Validator</option>
                                @foreach ($DataValidator as $key => $user)
                                    <option value={{ $user->id }}>
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputBorder"><code>Jenis Document</code></label>
                        <div class="input-group">
                            <select class="custom-select form-control-border" id="exampleSelectBorder" name="jenisdok"
                                placeholder="Semester">
                                <option value="none" selected disabled hidden>Pilih Jenis Document</option>          
                                    <option value="Proposal Riset">Proposal Riset</option>
                                    <option value="Proposal Abdimas">Proposal Abdimas</option>
                                    <option value="Laporan Antara Riset">Laporan Antara Riset</option>
                                    <option value="Laporan Akhir Riset">Laporan Akhir Riset</option>
                                    <option value="Laporan Akhir Abdimas">Laporan Akhir Abdimas</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputBorder"><code>Upload File</code></label>
                        <div class="input-group">
                            <input type="file" id="myfile" name="document">
                        </div>
                    </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- dropzonejs
-->

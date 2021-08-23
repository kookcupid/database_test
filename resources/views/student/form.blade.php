<form id="Form1">
  @csrf
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลนักเรียน</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="info" class="alert alert-warning" role="alert">
          <p id="pinfo">--</p>
          </div>

          <div class="row">
            <div class="col-6">
              <label  for="inputAddress2" class="form-label">รหัสนักเรียน</label>
              <input type="text" class="form-control" name="student_code" id="student_code" value="" placeholder="กรอกรหัสเรียน">
            </div> 
               
            <div class="row">
              <div class="col-6">
                <label  for="inputAddress2" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" name="student_fname" id="student_fname" value="" placeholder="กรอกชื่อ">
              </div>
              <div class="col-6">
                <label  for="inputAddress2" class="form-label">นามสกุล</label>
                <input type="text" class="form-control" name="student_lname" id="student_lname" value="" placeholder="กรอกนามสกุล">
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <label  for="inputAddress2" class="form-label">ระดับชั้น</label>
                <input type="text" class="form-control" name="student_class" id="student_class" value="" placeholder="กรอกระดับชั้น">
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <label  for="inputAddress2" class="form-label">เพศ</label>
                <input type="text" class="form-control" name="sex" id="sex" value="" placeholder="กรอกเพศ">
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <label  for="inputAddress2" class="form-label">ปีเกิด</label>
                <input type="text" class="form-control" name="birth_year" id="birth_year" value="" placeholder="กรอกปีเกิด">
              </div>
            </div>

          <div>
            <input type="hidden" name="edit_id" id="edit_id" value="">
            <input type="hidden" name="edit_mode" id="edit_mode" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" id='save' class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>




<!-- Delete -->
<div class="modal fade" id="del<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h4 class="modal-title" id="myModalLabel">ยกเลิกการประชุม</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <?php
                $del = mysqli_query($conn, "select * from events where id='" . $row['id'] . "'");
                $drow = mysqli_fetch_array($del);
                ?>
                <div class="container-fluid">
                    <h5>
                        <center>คุณต้องการที่จะยกเลิกการประชุม <strong><?php echo $drow['title']; ?></strong> หรือไม่ ?</center>
                    </h5>
                </div>
            </div>
            <div class="modal-footer">
                <a href="deletemeet-u.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>ยืนยัน</a>
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>ยกเลิก</button>
            </div>

        </div>
    </div>
</div>
<!-- /.modal -->

<!-- Edit -->
<div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h4 class="modal-title" id="myModalLabel">แก้ไขการประชุม</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <?php
                $edit = mysqli_query($conn, "select * from events where id='" . $row['id'] . "'");
                $erow = mysqli_fetch_array($edit);
                ?>
                <div class="container-fluid">
                    <form method="POST" action="editmeet-u.php?id=<?php echo $erow['id']; ?>" enctype="multipart/form-data">
                    <div class="row mb-2">
                            <div class="col-lg-3">
                                <label style="position:relative; top:7px;">วาระประชุม:</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" name="title" class="form-control" value="<?php echo $erow['title']; ?>">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-3">
                                <label style="position:relative; top:7px;">ประธานการประชุม:</label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control" id="head" name="head" value="<?php echo $erow['head']; ?>">
                                    <option value="นายกเทศมนตรี">นายกเทศมนตรี </option>
                                    <option value="รองนายกเทศมนตรี1">รองนายกเทศมนตรี1</option>
                                    <option value="รองนายกเทศมนตรี2">รองนายกเทศมนตรี2</option>
                                    <option value="รองนายกเทศมนตรี3">รองนายกเทศมนตรี3</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-3">
                                <label style="position:relative; top:7px;">จำนวนผู้เข้าประชุม:</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" name="numattend" class="form-control" value="<?php echo $erow['numattend']; ?>">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-3">
                                <label style="position:relative; top:7px;">ผู้เข้าร่วมประชุม:</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" name="listname" class="form-control" value="<?php echo $erow['listname']; ?>">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-3">
                                <label style="position:relative; top:7px;">ห้องประชุม:</label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control" id="roomid" name="roomid">
                                    <?php
                                    include('conn.php');
                                    $query2 = mysqli_query($conn, "select * from room");
                                    while ($row = mysqli_fetch_array($query2)) {
                                    ?>
                                        <option value="<?php echo $row['roomid']; ?>"><?php echo $row['roomname']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-3">
                                <label style="position:relative; top:7px;">เริ่มเวลา:</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="datetime-local" name="start" class="form-control" value="<?php echo $erow['start']; ?>" require>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-3">
                                <label style="position:relative; top:7px;">สิ้นสุดเวลา:</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="datetime-local" name="end" class="form-control" value="<?php echo $erow['end']; ?>" require>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-3">
                                <label style="position:relative; top:7px;">อุปกรณ์เพิ่มเติม:</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" name="addequipment" class="form-control" value="<?php echo $erow['addequipment']; ?>">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-3">
                                <label style="position:relative; top:7px;">หมายเหตุ:</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" name="remark" class="form-control" value="<?php echo $erow['remark']; ?>">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-3">
                                <label style="position:relative; top:7px;">ไฟล์เอกสาร:</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="file" name="meetfile" class="form-control" value="<?php echo $erow['meetfile']; ?>" require>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span>
                                ยกเลิก
                            </button>
                            <button type="submit" class="btn btn-warning">
                                <span class="glyphicon glyphicon-check"></span>
                                ยืนยันการแก้ไข
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- /.modal -->
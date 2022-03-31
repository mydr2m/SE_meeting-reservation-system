<!-- Delete -->
<div class="modal fade" id="del<?php echo $row['roomid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h4 class="modal-title" id="myModalLabel">ลบห้องประชุม</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <?php
                $del = mysqli_query($conn, "select * from room where roomid='" . $row['roomid'] . "'");
                $drow = mysqli_fetch_array($del);
                ?>
                <div class="container-fluid">
                    <h5>
                        <center>คุณต้องการที่จะลบห้องประชุม <strong><?php echo $drow['roomname']; ?></strong> หรือไม่</center>
                    </h5>
                </div>
            </div>
            <div class="modal-footer">
                <a href="deleteroom.php?roomid=<?php echo $row['roomid']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>ยืนยัน</a>
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>ยกเลิก</button>
            </div>

        </div>
    </div>
</div>
<!-- /.modal -->

<!-- Edit -->
<div class="modal fade" id="edit<?php echo $row['roomid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h4 class="modal-title" id="myModalLabel">แก้ไขห้องประชุม</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <?php
                $edit = mysqli_query($conn, "select * from room where roomid='" . $row['roomid'] . "'");
                $erow = mysqli_fetch_array($edit);
                ?>
                <div class="container-fluid">
                    <form method="POST" action="editroom.php?roomid=<?php echo $erow['roomid']; ?>">
                        <div class="row mb-2">
                            <div class="col-lg-2">
                                <label style="position:relative; top:7px;">ชื่อห้อง:</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="roomname" class="form-control" value="<?php echo $erow['roomname']; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-2">
                                <label style="position:relative; top:7px;">สถานที่:</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="location" class="form-control" value="<?php echo $erow['location']; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-2">
                                <label style="position:relative; top:7px;">ความจุห้อง:</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="capacity" class="form-control" value="<?php echo $erow['capacity']; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-2">
                                <label style="position:relative; top:7px;">มีโปรเจคเตอร์:</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="projector" class="form-control" value="<?php echo $erow['projector']; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-2">
                                <label style="position:relative; top:7px;">มีไมค์:</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="microphone" class="form-control" value="<?php echo $erow['microphone']; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-2">
                                <label style="position:relative; top:7px;">อื่นๆ:</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="others" class="form-control" value="<?php echo $erow['others']; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>ยกเลิก</button>
                            <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check"></span>ยืนยันการแก้ไข</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->
<div class="container">
    <script type="text/javascript">

        $(document).ready(function () {
            $("#startdate").datetimepicker({
                format: 'yyyy-mm-dd HH:ii'

            });
            $("#enddate").datetimepicker({
                format: 'yyyy-mm-dd HH:ii'

            });
        });
    </script>
    <div>
        <h3>Edit a work</h3>
        <?php if (isset($message)) {
            echo "<p style='color : red'>$message</p>";
        } ?>
        <form action="<?php echo URL; ?>works/edit/<?php echo htmlspecialchars($work->getId(), ENT_QUOTES, 'UTF-8'); ?>"
              method="POST">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-3 control-label">
                            <label for="work_name" class="control-label">Work Name</label>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input autofocus type="text" name="work_name"
                                       value="<?php echo htmlspecialchars($work->getWorkName(), ENT_QUOTES, 'UTF-8'); ?>"
                                       required/>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-3 control-label">
                            <label for="startdate" class="control-label">StartDate</label>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group date" id="startdate">
                                <input type="text" name="start_date"
                                       value="<?php echo htmlspecialchars($work->getStartDate(), ENT_QUOTES, 'UTF-8'); ?>"
                                       class="form-control"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon-calendar glyphicon"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-3 control-label">
                            <label for="enddate">EndDate</label>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group date" id="enddate">
                                <input type="text" name="end_date"
                                       value="<?php echo htmlspecialchars($work->getEndDate(), ENT_QUOTES, 'UTF-8'); ?>"
                                       class="form-control"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon-calendar glyphicon"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-3 control-label">
                            <label for="status" class="control-label">Status</label>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <select name="id_status" required>
                                    <?php foreach ($listStatus as $status) { ?>
                                        <option <?php if (null == !$status->getStatusId()) if ($work->getStatus() == $status->getStatusId()) echo "selected=\"selected\"" ?>
                                                value="<?php if (null == !$status->getStatusId()) echo htmlspecialchars($status->getStatusId(), ENT_QUOTES, 'UTF-8'); ?>">
                                            <?php if (null == !$status->getStatusName()) echo htmlspecialchars($status->getStatusName(), ENT_QUOTES, 'UTF-8'); ?>
                                        </option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" name="submit_edit_work" value="Edit Work"/>
            <button type="button"><a href="<?php echo URL; ?>works/delete/<?= $work->getId() ?>">Delete work<a/>
            </button>
        </form>
    </div>
</div>


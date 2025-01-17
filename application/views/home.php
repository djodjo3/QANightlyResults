<div class="navbar">
    <div class="navbar_container">
        <div class="links">
            <a class="link" href="/"><i class="material-icons">home</i> Home</a>
            <a class="link" href="/graph"><i class="material-icons">timeline</i> Graph</a>
        </div>
        <div class="title">
            <h2>Nightlies reports</h2>
        </div>
    </div>
</div>
<div class="container">
    <div class="details">
        <div class="options">
            <div class="blocks_container">
                <div class="block">
                    Filters :
                    <?php
                    if ($versions_list->num_rows() > 0) {
                        foreach($versions_list->result() as $version) {
                            echo '<span class="label filter_version active" data-for="version_'.str_replace('.', '', $version->version).'" data-active="true">'.$version->version.'</span>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="table_container">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Date</th>
                    <th>Version</th>
                    <th>Duration</th>
                    <th>Content</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        if ($execution_list->num_rows() > 0) {
                            foreach($execution_list->result() as $execution) {
                                $content = '';
                                if ($execution->passes > 0) {
                                    $content .= '<div class="content_block count_passed" title="Tests passed"><i class="material-icons">check_circle_outline</i> '.$execution->passes.'</div>';
                                }
                                if ($execution->failures > 0) {
                                    $content .= '<div class="content_block count_failed" title="Tests failed"><i class="material-icons">highlight_off</i> '.$execution->failures.'</div>';
                                }
                                if ($execution->skipped > 0) {
                                    $content .= '<div class="content_block count_skipped" title="Tests skipped"><i class="material-icons">radio_button_checked</i> '.$execution->skipped.'</div>';
                                }


                                echo '<tr class="version_'.str_replace('.', '', $execution->version).'">';
                                echo '<td><a href="/report/'.$execution->id.'" target="_blank"><i class="material-icons">visibility</i> Show report</a></td>';
                                echo '<td>'.date('d/m/Y', strtotime($execution->start_date)).'</td>';
                                echo '<td>'.$execution->version.'</td>';
                                echo '<td>'.date('H:i', strtotime($execution->start_date)).' - '.date('H:i', strtotime($execution->end_date)).' ('.duration($execution->duration/1000).')</td>';
                                echo '<td>'.$content.'</td>';
                                echo '</tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        let labels;
        $('.filter_version').click(function() {
            let version = $(this).attr('data-for');
            let active = $(this).attr('data-active');
            if (active === 'true') {
                $('table.table tbody  tr.'+version).hide();
                $(this).attr('data-active', 'false');
            } else {
                $('table.table tbody tr.'+version).show();
                $(this).attr('data-active', 'true');
            }

        });
    });
</script>

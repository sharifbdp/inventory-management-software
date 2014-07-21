<table border="1" width="200">
    <tbody>
        <tr>
            <td>Friend Name</td>
            <td>Friend Phone</td>
            <td>Friend Address</td>
        </tr>
        <?php
        foreach ($all_friends as $row) {
            echo "
<tr>
<td>" . $row->name . "</td>
<td>" . $row->last_login_date . "</td>
<td>" . $row->status . "</td>
</tr>";
        }
        "</tbody>
</table>";

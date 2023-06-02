<?php
$url = 'https://itunes.apple.com/search?term=Eminem';
$data = file_get_contents($url);
$result = json_decode($data, true);

print '<table  class="table gray-table"  style="width:70%">
        <thead>
            <tr>
                <th width="12" style="text-align:center" colspan="5">
                    <a href="index.php?menu=1">&larr; Back to Dachboard</a>
                </th>
            </tr>
            <tr>
                <th width="12" style="text-align:center">ARTIST NAME</th>
                <th width="12" style="text-align:center">COUNTRY</th>
                <th width="12" style="text-align:center">COLLECTION PRICE</th>
                <th width="12" style="text-align:center">TRACK NAME</th>
                <th width="12" style="text-align:center">RELEASE DATE</th>
            </tr>
        </thead>
        <tbody>';

foreach ($result['results'] as $item) {
    print '
            <tr>
    <td style="color:white; text-align:center">' . ($item['artistName'] ? $item['artistName'] : '<span style="color: red;">&#10006;</span>') . '</td>
    <td style="color:white; text-align:center">' . ($item['country'] ? $item['country'] : '<span style="color: red;">&#10006;</span>') . '</td>
    <td style="color:white; text-align:center">' . ($item['collectionPrice'] ? $item['collectionPrice'] : '<span style="color: red;">&#10006;</span>') . '</td>
    <td style="color:white; text-align:center">' . (isset($item['trackName']) ? $item['trackName'] : '<span style="color: red;">&#10006;</span>') . '</td>
    <td style="color:white; text-align:center">' . ($item['releaseDate'] ? $item['releaseDate'] : '<span style="color: red;">&#10006;</span>') . '</td>
</tr>';
}
print '
        </tbody>
    </table>';
?>
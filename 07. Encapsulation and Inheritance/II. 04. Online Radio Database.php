<?php
class Song
{
    private $artistName;
    private $songName;
    private $length;

    /**
     * Song constructor.
     * @param string $artistName
     * @param string $songName
     * @param array $length
     * @throws Exception
     */
    public function __construct(string $artistName, string $songName, array $length)
    {
        $this->setArtistName($artistName);
        $this->setSongName($songName);
        $this->setLength($length);
    }

    /**
     * @param string $artistName
     * @throws Exception
     */
    private function setArtistName(string $artistName){
        if (strlen($artistName) < 3 || strlen($artistName) > 20) {
            throw new Exception("Artist name should be between 3 and 20 symbols.");
        }
        $this->artistName = $artistName;
    }

    /**
     * @param string $songName
     * @throws Exception
     */
    private function setSongName(string $songName){
        if (strlen($songName) < 3 || strlen($songName) > 20) {
            throw new Exception("Song name should be between 3 and 30 symbols.");
        }
        $this->songName = $songName;
    }
    public function getLength(): array {
        return $this->length;
    }

    /**
     * @param array $length
     * @throws Exception
     */
    private function setLength(array $length){
        $minutes = $length[0];
        $seconds = $length[1];
        if ($minutes < 0 || $minutes > 14) {
            throw new Exception("Song minutes should be between 0 and 14.");
        }
        if ($seconds < 0 || $seconds > 59) {
            throw new Exception("Song seconds should be between 0 and 59.");
        }
        $this->length = [
            "minutes" => $minutes,
            "seconds" => $seconds];
    }
}
$n = intval(readline());
$playlist = [];
for ($i=0; $i < $n; $i++) {
    list($artist, $song, $length) = explode(";", readline());
    list($minutes, $seconds) = explode(":", $length);
    try{
        $nextSong = new Song($artist, $song, [intval($minutes), intval($seconds)]);
        echo "Song added." . PHP_EOL;
        $playlist[] = $nextSong;
    } catch (Exception $e){
        echo $e->getMessage() . PHP_EOL;
    }
}
echo "Songs added: " . count($playlist) . PHP_EOL;
echo "Playlist length: ";
$mins = 0;
$secs = 0;
$hours = 0;
foreach ($playlist as $song) {
    foreach ($song->getLength() as $key => $value) {
        if ($key == 'minutes') {
            $mins += $value;
        } elseif ($key == 'seconds') {
            $secs += $value;
        }
    }
}
$hours = intval($mins / 60 + $secs / 60 / 60);
$mins = $mins - intval($mins / 60) * 60 + intval($secs / 60) - intval($secs / 60 / 60) * 60 == 60 ? 0 : $mins - intval($mins / 60) * 60 + intval($secs / 60) - intval($secs / 60 / 60) * 60;
$secs = $secs % 60;
$mins = str_pad($mins, 2, "0", STR_PAD_LEFT);
$secs = str_pad($secs, 2 , '0', STR_PAD_LEFT);
echo "{$hours}h {$mins}m {$secs}s";

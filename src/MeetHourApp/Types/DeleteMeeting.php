<?php
namespace MeetHourApp\Types;
class DeleteMeeting {
    public int $meeting_id;

    public function __construct(int $meeting_id) {
        $this->meeting_id = $meeting_id;
    }
    public function prepare() {
        $deleteMeetingProperties = [
            "meeting_id" => $this->meeting_id
        ];
        foreach ($deleteMeetingProperties as $key => $value) {
            if ($value === null) {
              unset($deleteMeetingProperties[$key]);
            }
          }
        return $deleteMeetingProperties;
    }
}
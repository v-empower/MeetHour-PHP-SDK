<?php
class ScheduleMeetingType {
  public ?string $agenda;
  public ?array $attend;
  public ?string $default_recording_storage;
  public ?int $duration_hr;
  public ?int $duration_min;
  public ?int $enable_pre_registration;
  public ?string $endBy;
  public ?string $end_date_time;
  public ?int $end_times;
  public ?array $groups;
  public ?array $hostusers;
  public ?string $instructions;
  public ?int $is_recurring;
  public ?int $is_show_portal;
  public string $meeting_agenda;
  public string $meeting_date;
  public string $meeting_meridiem;
  public string $meeting_name;
  public string $meeting_time;
  public ?string $meeting_topic;
  public ?string $monthlyBy;
  public ?string $monthlyByDay;
  public ?string $monthlyByWeekday;
  public ?string $monthlyByWeekdayIndex;
  public ?array $options;
  public string $passcode;
  public ?string $recurring_type;
  public ?int $repeat_interval;
  public ?int $send_calendar_invite;
  public string $timezone;
  public ?int $weeklyWeekDays;
  
  public function __construct() {
    $this->agenda = null;
    $this->attend = null;
    $this->default_recording_storage = null;
    $this->duration_hr = null;
    $this->duration_min = null;
    $this->enable_pre_registration = null;
    $this->endBy = null;
    $this->end_date_time = null;
    $this->end_times = null;
    $this->groups = null;
    $this->hostusers = null;
    $this->instructions = null;
    $this->is_recurring = null;
    $this->is_show_portal = null;
    $this->meeting_agenda = null;
    $this->meeting_date = null;
    $this->meeting_meridiem = null;
    $this->meeting_name = null;
    $this->meeting_time = null;
    $this->meeting_topic = null;
    $this->monthlyBy = null;
    $this->monthlyByDay = null;
    $this->monthlyByWeekday = null;
    $this->monthlyByWeekdayIndex = null;
    $this->options = null;
    $this->passcode = null;
    $this->recurring_type = null;
    $this->repeat_interval = null;
    $this->send_calendar_invite = null;
    $this->timezone = null;
    $this->weeklyWeekDays = null;
  }
  
}
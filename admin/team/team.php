<?php
require_once('../../config.php');
require_once('../../lib/jsonReader.php');

function getMembers()
{
    $team = readJsonFile(TEAM_DATA);
    return $team;
}

function getMember($id)
{
    $team = getMembers();
    if (isset($team[$id])) {
        return $team[$id];
    }
    return null;
}

function addMember($data)
{
    appendJsonFile(TEAM_DATA, $data);
}

function updateMember($id, $data)
{
    $team = getMembers();
    if (isset($team[$id])) {
        $team[$id] = $data;
        return writeJsonFile(TEAM_DATA, $team);
    }
    return false;
}

function deleteTeamMember($id)
{
    $team = getMembers();
    if (isset($team[$id])) {
        unset($team[$id]);
        $team = array_values($team);
        $json_data = json_encode($team, JSON_PRETTY_PRINT);
        file_put_contents(TEAM_DATA, $json_data);
        return true;
    }
    return false;
}

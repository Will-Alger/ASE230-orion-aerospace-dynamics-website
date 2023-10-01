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

function deleteMember($id)
{
    $team = getMembers();
    if (isset($team[$id])) {
        unset($team[$id]);
        $team = array_values($team);
        return writeJsonFile(TEAM_DATA, $team);
    }
    return false;
}

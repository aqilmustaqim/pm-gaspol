<?php

function check_member($idteam, $iduser)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('detail_team');
    $builder->select('*');
    $builder->where('id_team', $idteam);
    $builder->where('id_users', $iduser);
    $query = $builder->get();
    $access = $query->getResultArray();

    if ($access) {
        return "checked='checked'";
    }
}

function check_member_project($idProject, $iduser)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('detail_project');
    $builder->select('*');
    $builder->where('id_project', $idProject);
    $builder->where('id_users', $iduser);
    $query = $builder->get();
    $access1 = $query->getResultArray();


    if ($access1) {
        return "checked='checked'";
    }
}

function check_member_task($idTask, $iduser)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('detail_task');
    $builder->select('*');
    $builder->where('id_task', $idTask);
    $builder->where('id_users', $iduser);
    $query = $builder->get();
    $access2 = $query->getResultArray();


    if ($access2) {
        return "checked='checked'";
    }
}

function totalProject($idTeam)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('project');
    $builder->selectCount('id');
    $builder->where('id_team', $idTeam);
    $query = $builder->get();
    $access4 = $query->getResultArray();


    return $access4;
}

function check_list($idList)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('list_task');
    $builder->select('*');
    $builder->where('id', $idList);
    $builder->where('status_list', 1);
    $query = $builder->get();
    $access3 = $query->getResultArray();

    if ($access3) {
        return "checked='checked'";
    }
}

function detailFotoTeam($idTeam)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('detail_team');
    $builder->select('nama,foto');
    $builder->join('team', 'detail_team.id_team = team.id');
    $builder->join('users', 'detail_team.id_users = users.id');
    $builder->where('id_team', $idTeam);
    $query = $builder->get();
    $detailteam = $query->getResultArray();

    return $detailteam;
}

function detailFotoProject($idProject)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('detail_project');
    $builder->select('nama,foto');
    $builder->join('project', 'detail_project.id_project = project.id');
    $builder->join('users', 'detail_project.id_users = users.id');
    $builder->where('id_project', $idProject);
    $query = $builder->get();
    $detailProject = $query->getResultArray();

    return $detailProject;
}
function detailFotoTask($idTask)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('detail_task');
    $builder->select('nama,foto');
    $builder->join('task', 'detail_task.id_task = task.id');
    $builder->join('users', 'detail_task.id_users = users.id');
    $builder->where('id_task', $idTask);
    $query = $builder->get();
    $detailTask = $query->getResultArray();

    return $detailTask;
}

function jumlahMemberTeam($idTeam)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('detail_team');
    $builder->selectCount('detail_team.id');
    $builder->where('id_team', $idTeam);
    $query = $builder->get();
    $jumlahMemberTeam = $query->getRowArray();

    return $jumlahMemberTeam;
}

function totalProjectTeam($idTeam)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('project');
    $builder->selectCount('project.id');
    $builder->where('id_team', $idTeam);
    $query = $builder->get();
    $totalProjectTeam = $query->getRowArray();

    return $totalProjectTeam;
}

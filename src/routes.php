<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;
use DataSource\Time\Time;
use DataSource\Jogo\Jogo;
use DataSource\Local\Local;

// Ajustando o horário
date_default_timezone_set('America/Sao_Paulo');

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

// API group
$app->group('/api', function () use ($app) {
    // Version group
    $app->group('/v1', function () use ($app) {
        $app->get('/', function (Request $request, Response $response) {
            $this->logger->addInfo('Exibindo mensagem de boas vindas.');
            $mensagem = 'Seja bem-vindo a API v1';
        
            return $response->withJson($mensagem);
        });
		$app->get('/times', function (Request $request, Response $response) {
            $this->logger->addInfo('Listando times cadastrados.');
            $times = $this->atlas->select(Time::CLASS)->fetchRecordSet();
        
            return $response->withJson($times);
        });
		$app->get('/times/{id}', function (Request $request, Response $response, $args) {
            $this->logger->addInfo('Listando time '. $args['id'] .' cadastrado.');
            $id = (int) $args['id'];
            $time = $this->atlas->fetchRecord(Time::CLASS, $id);

            return $response->withJson($time);
        });
		$app->post('/times', function (Request $request, Response $response, $args) {
            $this->logger->addInfo('Adicionando novo time.');
            $data = $request->getParsedBody();
            $directory = $this->get('upload_directory');
            $webdir = $this->get('webdir_upload');

            $time = $this->atlas->newRecord(Time::CLASS);
            $time->nome = filter_var($data['nome'], FILTER_SANITIZE_STRING);
            $time->sigla = filter_var($data['sigla'], FILTER_SANITIZE_STRING);


            $uploadedFiles = $request->getUploadedFiles();

            $filename = '#';
            // handle single input with single file upload
            if($uploadedFiles && $uploadedFiles['flag']){
                $uploadedFile = $uploadedFiles['flag'];
                if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                    $filename = moveUploadedFile($directory, $uploadedFile);
                }
            }            

            $time->path = $webdir.$filename;
            $time->created = date('Y-m-d h:i:s');
            $time->updated = date('Y-m-d h:i:s');

            if(!objectIsEmpty($time)){
                $return = $this->atlas->persist($time);
            }

            return $response->withJson(true);
        });
        $app->post('/times/{id}/flag', function (Request $request, Response $response, $args) {
            $this->logger->addInfo('Atualizando time '. $args['id'] .'.');
            $id = (int) $args['id'];

            $directory = $this->get('upload_directory');
            $webdir = $this->get('webdir_upload');

            $uploadedFiles = $request->getUploadedFiles();

            $filename = '#';
            // handle single input with single file upload
            if($uploadedFiles && $uploadedFiles['flag']){
                $uploadedFile = $uploadedFiles['flag'];
                if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                    $this->logger->addInfo('Inserindo imagem no diretório '. $directory .'.');
                    $filename = moveUploadedFile($directory, $uploadedFile);
                }
            }  

            $time = $this->atlas->fetchRecord(Time::class, $id);
            $time->path = $webdir.$filename;
            $time->updated = date('Y-m-d h:i:s');

            if(!objectIsEmpty($time)){
                $return = $this->atlas->persist($time);
            }

            return $response->withJson(true);

        });
		$app->put('/times/{id}', function (Request $request, Response $response, $args) {
            $this->logger->addInfo('Atualizando time '. $args['id'] .'.');
            $id = (int) $args['id'];
            $data = $request->getParsedBody();

            $time = $this->atlas->fetchRecord(Time::class, $id);
            $time->nome = filter_var($data['nome'], FILTER_SANITIZE_STRING);
            $time->sigla = filter_var($data['sigla'], FILTER_SANITIZE_STRING);
            $time->updated = date('Y-m-d h:i:s');

            if(!objectIsEmpty($time)){
                $return = $this->atlas->persist($time);
            }

            return $response->withJson(true);
        });
		$app->delete('/times/{id}', function (Request $request, Response $response, $args) {
            $this->logger->addInfo('Apagando time '. $args['id'] .'.');
            $id = (int) $args['id'];
            $time = $this->atlas->fetchRecord(Time::class, $id);

            if(!objectIsEmpty($time)){
                $return = $this->atlas->delete($time);
            }
            
            return $response->withJson(true);
        });

        $app->get('/times/{id}/jogos', function (Request $request, Response $response, $args) {
            $this->logger->addInfo('Listando jogos cadastrados.');
            $id = (int) $args['id'];
            $jogos = $this->atlas
                ->select(Jogo::CLASS)
                ->columns(
                    'jogos.id', 
                    'jogos.descricao', 
                    'jogos.horario', 
                    'v.sigla as visitante_sigla', 
                    'v.nome as visitante_nome', 
                    'm.sigla as mandante_sigla', 
                    'm.nome as mandante_nome', 
                    'l.nome as local_nome'
                )
                ->join('INNER', 'times AS v', 'visitante = v.id')
                ->join('INNER', 'times AS m', 'mandante = m.id')
                ->join('INNER', 'locais AS l', 'local = l.id')
                ->where('visitante = ', $id)
                ->orWhere('mandante = ', $id)
                ->fetchAll();
        
            return $response->withJson($jogos);
        });

        $app->get('/jogos/horarios/{horario}', function (Request $request, Response $response, $args) {
            $this->logger->addInfo('Listando jogos cadastrados.');
            $horario = filter_var($args['horario'], FILTER_SANITIZE_STRING);
            $jogos = $this->atlas
                ->select(Jogo::CLASS)
                ->columns(
                    'jogos.id', 
                    'jogos.descricao', 
                    'jogos.horario', 
                    'v.sigla as visitante_sigla', 
                    'v.nome as visitante_nome', 
                    'm.sigla as mandante_sigla', 
                    'm.nome as mandante_nome', 
                    'l.nome as local_nome'
                )
                ->join('INNER', 'times AS v', 'visitante = v.id')
                ->join('INNER', 'times AS m', 'mandante = m.id')
                ->join('INNER', 'locais AS l', 'local = l.id')
                ->where('horario = ', $horario)
                ->fetchAll();
        
            return $response->withJson($jogos);
        });
    
        $app->get('/jogos', function (Request $request, Response $response) {
            $this->logger->addInfo('Listando jogos cadastrados.');
            $jogos = $this->atlas
                ->select(Jogo::CLASS)
                ->columns(
                    'jogos.id', 
                    'jogos.descricao', 
                    'jogos.horario', 
                    'v.sigla as visitante_sigla', 
                    'v.nome as visitante_nome', 
                    'm.sigla as mandante_sigla', 
                    'm.nome as mandante_nome', 
                    'l.nome as local_nome'
                )
                ->join('INNER', 'times AS v', 'visitante = v.id')
                ->join('INNER', 'times AS m', 'mandante = m.id')
                ->join('INNER', 'locais AS l', 'local = l.id')
                ->fetchAll();
        
            return $response->withJson($jogos);
        });
        $app->get('/jogos/{id}', function (Request $request, Response $response, $args) {
            $this->logger->addInfo('Listando jogo '. $args['id'] .' cadastrado.');
            $id = (int) $args['id'];
            $jogo = $this->atlas->fetchRecord(Jogo::CLASS, $id);

            return $response->withJson($jogo);
        });
        $app->post('/jogos', function (Request $request, Response $response, $args) {
            $this->logger->addInfo('Adicionando novo jogo.');
            $data = $request->getParsedBody();       
            
            $mandante = $this->atlas->fetchRecord(Time::CLASS, (int) $data['mandante']);
            $visitante = $this->atlas->fetchRecord(Time::CLASS, (int) $data['visitante']);
            $local = $this->atlas->fetchRecord(Local::CLASS, (int) $data['local']);

            if(objectIsEmpty($mandante)){
                return $response->withJson('mandante não encontrado', 401);
            }

            if(objectIsEmpty($visitante)){
                return $response->withJson('visitante não encontrado', 401);
            }

            if(objectIsEmpty($local)){
                return $response->withJson('local não encontrado', 401);
            }

            $jogo = $this->atlas->newRecord(Jogo::CLASS);
            $jogo->descricao = filter_var($data['descricao'], FILTER_SANITIZE_STRING);
            $jogo->local = filter_var($data['local'], FILTER_SANITIZE_NUMBER_INT);
            $jogo->mandante = filter_var($data['mandante'], FILTER_SANITIZE_NUMBER_INT);
            $jogo->visitante = filter_var($data['visitante'], FILTER_SANITIZE_NUMBER_INT);
            $jogo->horario = filter_var($data['horario'], FILTER_SANITIZE_STRING);
            $jogo->created = date('Y-m-d h:i:s');
            $jogo->updated = date('Y-m-d h:i:s');

            if(!objectIsEmpty($jogo)){
                $return = $this->atlas->persist($jogo);
            }

            return $response->withJson(true);
        });
        $app->put('/jogos/{id}', function (Request $request, Response $response, $args) {
            $this->logger->addInfo('Atualizando jogo '. $args['id'] .'.');
            $id = (int) $args['id'];
            $data = $request->getParsedBody();

            $jogo = $this->atlas->fetchRecord(Jogo::CLASS, $id);
            $mandante = $this->atlas->fetchRecord(Time::CLASS, (int) $data['mandante']);
            $visitante = $this->atlas->fetchRecord(Time::CLASS, (int) $data['visitante']);
            $local = $this->atlas->fetchRecord(Local::CLASS, (int) $data['local']);

            if(objectIsEmpty($jogo)){
                return $response->withJson('jogo não encontrado', 401);
            }

            if(objectIsEmpty($mandante)){
                return $response->withJson('mandante não encontrado', 401);
            }

            if(objectIsEmpty($visitante)){
                return $response->withJson('visitante não encontrado', 401);
            }

            if(objectIsEmpty($local)){
                return $response->withJson('local não encontrado', 401);
            }


            $jogo->descricao = filter_var($data['descricao'], FILTER_SANITIZE_STRING);
            $jogo->local = filter_var($data['local'], FILTER_SANITIZE_NUMBER_INT);
            $jogo->mandante = filter_var($data['mandante'], FILTER_SANITIZE_NUMBER_INT);
            $jogo->visitante = filter_var($data['visitante'], FILTER_SANITIZE_NUMBER_INT);
            $jogo->horario = filter_var($data['horario'], FILTER_SANITIZE_STRING);
            $jogo->updated = date('Y-m-d h:i:s');

            if(!objectIsEmpty($jogo)){
                $return = $this->atlas->persist($jogo);
            }

            return $response->withJson(true);
        });
        $app->delete('/jogos/{id}', function (Request $request, Response $response, $args) {
            $this->logger->addInfo('Apagando jogo '. $args['id'] .'.');
            $id = (int) $args['id'];
            $jogo = $this->atlas->fetchRecord(Jogo::class, $id);

            if(!objectIsEmpty($jogo)){
                $return = $this->atlas->delete($jogo);
            }

            return $response->withJson(true);
        });
        $app->get('/locais', function (Request $request, Response $response) {
            $this->logger->addInfo('Listando locais cadastrados.');
            $locais = $this->atlas->select(Local::CLASS)->fetchRecordSet();
        
            return $response->withJson($locais);
        });
        $app->get('/locais/{id}', function (Request $request, Response $response, $args) {
            $this->logger->addInfo('Listando local '. $args['id'] .' cadastrado.');
            $id = (int) $args['id'];
            $local = $this->atlas->fetchRecord(Local::CLASS, $id);

            return $response->withJson($local);
        });
        $app->post('/locais', function (Request $request, Response $response, $args) {
            $this->logger->addInfo('Adicionando novo local.');
            $data = $request->getParsedBody();       

            $local = $this->atlas->newRecord(Local::CLASS);
            $local->nome = filter_var($data['nome'], FILTER_SANITIZE_STRING);
            $local->created = date('Y-m-d h:i:s');
            $local->updated = date('Y-m-d h:i:s');

            if(!objectIsEmpty($local)){
                $return = $this->atlas->persist($local);
            }

            return $response->withJson(true);
        });
        $app->put('/locais/{id}', function (Request $request, Response $response, $args) {
            $this->logger->addInfo('Atualizando local '. $args['id'] .'.');
            $id = (int) $args['id'];
            $data = $request->getParsedBody();

            $local = $this->atlas->fetchRecord(Local::CLASS, $id);
            $local->nome = filter_var($data['nome'], FILTER_SANITIZE_STRING);
            $local->updated = date('Y-m-d h:i:s');

            if(!objectIsEmpty($local)){
                $return = $this->atlas->persist($local);
            }

            return $response->withJson(true);
        });
        $app->delete('/locais/{id}', function (Request $request, Response $response, $args) {
            $this->logger->addInfo('Apagando local '. $args['id'] .'.');
            $id = (int) $args['id'];
            $local = $this->atlas->fetchRecord(Local::class, $id);

            if(!objectIsEmpty($local)){
                $return = $this->atlas->delete($local);
            }

            return $response->withJson(true);
        });
    });
});

// Catch-all route to serve a 404 Not Found page if none of the routes match
// NOTE: make sure this route is defined last
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});

/**
 * Moves the uploaded file to the upload directory and assigns it a unique name
 * to avoid overwriting an existing uploaded file.
 *
 * @param string $directory directory to which the file is moved
 * @param UploadedFile $uploaded file uploaded file to move
 * @return string filename of moved file
 */
function moveUploadedFile($directory, UploadedFile $uploadedFile)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
}

function objectIsEmpty($object){
    if($object)
    {
        return empty((array)$object);
    }
    else
    {
        return true;
    }
}


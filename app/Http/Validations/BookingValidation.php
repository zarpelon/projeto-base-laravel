<?php

namespace App\Http\Validation;

use App\Helpers\ResponseHelper;
use App\Booking;

/**
 * Realiza as validações negociais das requisições de Reserva de Salas
 *
 * @author Diogo Zarpelon (zarpelon@gmail.com)
 */
class BookingValidation implements IValidation {

    /**
     * Injeta a model necessária para as validações
     *
     */
    public function __construct(Booking $booking) {
        $this->model = $booking;
    }

    /**
     * Validação do salvamento de uma reserva
     *
     * @param array $dados
     * @param type $id
     * @param type $validateId
     * @return type
     */
    public function validate(array $data, $id = 0) 
    {
        # Validação para não permitir que as datas sejam menores que a data atual
        $from_date = \DateTime::createFromFormat('d/m/Y H:i:s', $data['from_date']);

        $user_bookings = $this->model
                         ->whereUserId($data['user_id'])
                         ->whereRaw("'".$from_date->format('Y-m-d H:i:s')."' BETWEEN from_date AND to_date");
        
        if (count($user_bookings->get()) > 0) {
            return ['success' => false, 'msg' => 'Já existe uma reserva de salas para seu usuário nesse período.'];
        }

        $bookings = $this->model
                         ->whereRoomId($data['room_id'])
                         ->whereRaw("'".$from_date->format('Y-m-d H:i:s')."' BETWEEN from_date AND to_date");
        
        if (count($bookings->get()) > 0) {
            return ['success' => false, 'msg' => 'Já existe uma reserva de salas para essa sala nesse período.'];
        }

        return ['success' => true];
/*
        if ($validaDatas !== true) {
            return ResponseHelper::responseError([], $validaDatas->first(), false);
        }

        # Valida em novos cadastros se não existe uma conferência para a mesma cidade.
        if (empty($dados['id'])) {
            if ($dados['tipo'] == 1) {
                if ($this->conferenciaRepository->verificarMinCidade($dados['cidades']) == false) {
                    return ResponseHelper::responseError([], 'É necessário informar ao menos 2 municípios para Conferência Intermunicipal!', false);
                }
            }

            $validaDuplicidade = $this->conferenciaRepository->verificarDuplicidade($dados['cidades']);
            if (count($validaDuplicidade) > 0) {
                return ResponseHelper::responseError([], 'Já existe uma Conferência cadastrada para '.$validaDuplicidade->implode(', '), false);
            }
        }

        return ResponseHelper::responseSuccess([], '', false);
    */
    }
}

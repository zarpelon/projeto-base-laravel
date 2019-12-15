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
        # Validação negocial para não permitir que o mesmo usuário reserve alguma sala mais de uma vez
        $from_date = \DateTime::createFromFormat('d/m/Y H:i:s', $data['from_date']);

        $user_bookings = $this->model
                         ->whereUserId($data['user_id'])
                         ->whereRaw("'".$from_date->format('Y-m-d H:i:s')."' BETWEEN from_date AND to_date");
        
        if (count($user_bookings->get()) > 0) {
            return ['success' => false, 'msg' => 'Já existe uma reserva de salas para seu usuário nesse período.'];
        }

        # Validação negocial para não permitir que possa realizar mais de uma reserva para a mesma sala no mesmo período
        $bookings = $this->model
                         ->whereRoomId($data['room_id'])
                         ->whereRaw("'".$from_date->format('Y-m-d H:i:s')."' BETWEEN from_date AND to_date");
        
        if (count($bookings->get()) > 0) {
            return ['success' => false, 'msg' => 'Já existe uma reserva de salas para essa sala nesse período.'];
        }

        return ['success' => true];
    }
}

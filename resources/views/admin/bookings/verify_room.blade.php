        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Sala</th>
              <th scope="col">De</th>
              <th scope="col">Até</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($bookings as $booking)
              <tr>
                <td>{{ $booking->room->name }}</td>
                <td>{{ $booking->from_date}}</td>
                <td>{{ $booking->to_date}}</td>
              </tr>
            @endforeach

          </tbody>
        </table>

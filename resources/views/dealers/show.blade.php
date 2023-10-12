<x-dashboard-layout>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dealer Details</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Business Name:</th>
                            <td>{{ $org->business_name }}</td>
                            <th>Business Address:</th>
                            <td>{{ $org->business_address }}</td>
                        </tr>
                        <tr>
                            <th>Business Website:</th>
                            <td>{{ $org->business_website }}</td>
                            <th>Business Email:</th>
                            <td>{{ $org->business_email }}</td>
                        </tr>

                        <tr>
                            <th>Business Phone:</th>
                            <td>{{ $org->business_phone }}</td>
                            <th>PCI DSS Compliance:</th>
                            <td>
                                @if($org->business_PCI_DSS_compliance_status == 1)
                                <h6 class="badge bg-success">Yes</h6>
                                @else
                                <h6 class="badge bg-danger">No</h6>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>HTTPS Compliance:</th>
                            <td>
                                @if($org->business_HTTPS_compliance_status == 1)
                                <h6 class="badge bg-success">Yes</h6>
                                @else
                                <h6 class="badge bg-danger">No</h6>
                                @endif
                            </td>
                            <th>Business Bank Account Name:</th>
                            <td>{{ $org->business_bank_account_name }}</td>
                        </tr>

                        <tr>
                            <th>Business Bank A/C Address:</th>
                            <td>{{ $org->business_bank_account_address }}</td>
                            <th>Business Bank Name:</th>
                            <td>{{ $org->business_bank_name }}</td>
                        </tr>

                        <tr>
                            <th>Business Bank Address:</th>
                            <td>{{ $org->business_bank_address }}</td>
                            <th>Business IBAN:</th>
                            <td>{{ $org->business_bank_IBAN }}</td>
                        </tr>

                        <tr>
                            <th>Business IFSC:</th>
                            <td>{{ $org->business_bank_IFSC }}</td>
                            <th>Business SWIFT Code:</th>
                            <td>{{ $org->business_bank_SWIFT_code }}</td>
                        </tr>

                        <tr>
                            <th>Business Bank Routing Code:</th>
                            <td>{{ $org->business_bank_routing_code }}</td>
                        </tr>
                    </table>
                    <div class="col-md-12 mb-3">
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Uploaded Documents</h5>
                    </div>
                    <ol>
                        @foreach($docs as $doc)
                                <li><a href="{{Storage::URL($doc->document_filepath)}}" target="_blank">{{$doc->document_name}}</a></li>
                        @endforeach
                    </ol>

                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>

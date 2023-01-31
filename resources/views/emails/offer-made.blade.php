Hello {{ $user->name }}!

Made new offer #{{ $offer->id  }} with price {{ $offer->amount }}.

See your offer here {{ route('realtor.apartment.show', ['apartment' => $offer->apartment_id])  }}

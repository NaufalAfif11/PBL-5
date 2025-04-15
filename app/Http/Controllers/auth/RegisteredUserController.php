$request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|string|email|max:255|unique:users',
    'password' => 'required|string|confirmed|min:8',
    'birthdate' => 'required|date',
]);

User::create([
    'name' => $request->name,
    'email' => $request->email,
    'birthdate' => $request->birthdate,
    'password' => Hash::make($request->password),
]);

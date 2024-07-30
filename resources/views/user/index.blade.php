<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ข้อมูลลูกค้า') }}
        </h2>
    </x-slot>
    <div class="mx-auto pl-5 my-3 py-3 ">
        <div class="flex flex-col items-center w-full h-full px-4 py-4 -mx-4 sm:-mx-8 sm:px-8 lg:px-6">
            <div class="inline-block w-full rounded-lg shadow overflow-x-auto">
                <table class="table-auto leading-normal w-full" id="table-user">
                    <thead>
                        <tr>
                            <th 
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                @sortablelink('id', 'รหัสลูกค้า') 
                            </th>
                            <th 
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                @sortablelink('name', 'ชื่อลูกค้า')  
                            </th>
                            <th 
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                @sortablelink('email', 'อีเมล') 
                            </th>
                            <th 
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                @sortablelink('userType', 'ประเภทผู้ใช้') 
                            </th>
                            <th 
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                @sortablelink('phone', 'เบอร์โทรศัพท์') 
                            </th>

                            <th 
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                ดำเนินการ
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-400">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4 text-center">{{ $user->id }}</td>
                                <td class="px-6 py-4 text-center">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-center">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span>{{ $user->userType }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">{{ $user->phone ?? '-' }}</td>
                                <td class="px-4 py-2 text-center">
                                    <button type="button" onclick="openModal('{{ $user->id }}')"
                                        class="text-black hover:text-white border border-yellow-400 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-4 mt-3 dark:border-yellow-500 dark:text-yellow-500 dark:hover:text-white dark:hover:bg-yellow-600 dark:focus:ring-yellow-900">
                                        แก้ไข
                                    </button>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        id="deleteForm-{{ $user->id }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="deleteUser('{{ $user->id }}')"
                                            class="text-black hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                            ลบ
                                        </button>
                                    </form>
                                </td>
                                    <style>
                                        .modal-overlay {
                                            display: none;
                                            position: fixed;
                                            top: 0;
                                            left: 0;
                                            height: 100%;
                                            width: 100%;
                                            background-color: rgba(0, 0, 0, 0.5);
                                        }

                                        .modal-content {
                                            position: fixed;
                                            top: 50%;
                                            left: 50%;
                                            transform: translate(-50%, -50%);
                                            background-color: #fff;
                                            padding: 20px;
                                            border-radius: 8px;
                                            width: 500px;
                                        }
                                    </style>


                                    <div id="modal-{{ $user->id }}" class="modal-overlay">
                                        <div class="modal-content">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                                แก้ไขข้อมูลลูกค้า</h3>
                                            <form action="{{ route('users.update', $user->id) }}" method="POST"
                                                id="editForm-{{ $user->id }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="mt-2 mx-28">
                                                    <label for="name-{{ $user->id }}"
                                                        class="text-sm text-gray-500 block text-center">ชื่อลูกค้า</label>
                                                    <input type="text" name="name" id="name-{{ $user->id }}"
                                                        value="{{ $user->name }}" class="block mx-auto">
                                                </div>
                                                <div class="mt-2 mx-28">
                                                    <label for="email-{{ $user->id }}"
                                                        class="text-sm text-gray-500 block text-center">อีเมล</label>
                                                    <input type="email" name="email" id="email-{{ $user->id }}"
                                                        value="{{ $user->email }}" class="block mx-auto">
                                                </div>
                                                <div class="mt-2 mx-28">
                                                    <label for="userType-{{ $user->id }}"
                                                        class="text-sm text-gray-500 block text-center">ประเภทผู้ใช้</label>
                                                    <select name="userType" id="userType-{{ $user->id }}"
                                                        class="block mx-auto">
                                                        <option value="USR"
                                                            {{ $user->userType === 'USR' ? 'selected' : '' }}>USR
                                                        </option>
                                                        <option value="ADM"
                                                            {{ $user->userType === 'ADM' ? 'selected' : '' }}>ADM
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="mt-2 mx-28">
                                                    <label for="phone-{{ $user->id }}"
                                                        class="text-sm text-gray-500 block text-center">เบอร์โทรศัพท์</label>
                                                    <input type="text" name="phone" id="phone-{{ $user->id }}"
                                                        value="{{ $user->phone ?? '' }}" class="block mx-auto">
                                                </div>
                                                <div class="mt-2 mx-28">
                                                    <label for="password-{{ $user->id }}"
                                                        class="text-sm text-gray-500 block text-center">รหัสผ่าน</label>
                                                    <input type="password" name="password"
                                                        id="password-{{ $user->id }}"
                                                        value="{{ $user->password }}" class="block mx-auto">
                                                </div>
                                                <div class="mt-2 mx-28 flex justify-center">
                                                    <button type="button" onclick="saveUser('{{ $user->id }}')"
                                                        class="bg-green-500 hover:bg-green-700 text-white font-bold mx-2 py-2 px-4 rounded">
                                                        บันทึก
                                                    </button>
                                                    <button type="button" onclick="closeModal('{{ $user->id }}')"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold mx-2 py-2 px-4 rounded">
                                                        ยกเลิก
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                        

                                <script>
                                    function openModal(userId) {
                                        var modal = document.getElementById('modal-' + userId);
                                        modal.style.display = "block";
                                    }

                                    function closeModal(userId) {
                                        var modal = document.getElementById('modal-' + userId);
                                        modal.style.display = "none";
                                    }

                                    function saveUser(userId) {
                                        var editForm = document.getElementById('editForm-' + userId);
                                        // เปลี่ยนข้อมูลในฐานข้อมูล
                                        editForm.submit();
                                        // เพิ่มข้อความแสดงถึงการบันทึกข้อมูลเรียบร้อยแล้ว
                                        alert('บันทึกข้อมูลเรียบร้อยแล้ว');
                                        // ปิด Modal หลังจากบันทึกข้อมูล
                                        closeModal(userId);
                                    }
                                </script>

                                <script>
                                    function deleteUser(userId) {
                                        if (confirm('คุณแน่ใจหรือไม่ที่ต้องการลบข้อมูลนี้?')) {
                                            var deleteForm = document.getElementById('deleteForm-' + userId);
                                            deleteForm.submit();
                                            alert('ลบข้อมูลเรียบร้อยแล้ว');
                                        }
                                    }
                                </script>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
            {{ $users->appends(Request::except('page'))->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
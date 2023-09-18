from collections import deque

# Fungsi untuk menghasilkan langkah-langkah yang mungkin dari papan saat ini
def get_possible_moves(state):
    moves = []
    zero_index = state.index(0)
    
    # Aturan pergerakan
    if zero_index % 3 > 0:
        moves.append(-1)  # Geser ke kiri
    if zero_index % 3 < 2:
        moves.append(1)   # Geser ke kanan
    if zero_index // 3 > 0:
        moves.append(-3)  # Geser ke atas
    if zero_index // 3 < 2:
        moves.append(3)   # Geser ke bawah
    
    return moves

# Fungsi untuk mencetak papan
def print_puzzle(state):
    for i in range(0, 9, 3):
        print(state[i], state[i + 1], state[i + 2])
    print()

# Fungsi untuk menjalankan BFS
def bfs(initial_state, goal_state):
    queue = deque()
    visited = set()
    
    queue.append((initial_state, []))
    
    while queue:
        current_state, path = queue.popleft()
        visited.add(tuple(current_state))
        
        print("Tahap:")
        print_puzzle(current_state)
        
        if current_state == goal_state:
            return path
        
        zero_index = current_state.index(0)
        possible_moves = get_possible_moves(current_state)
        
        for move in possible_moves:
            new_state = current_state[:]
            new_state[zero_index], new_state[zero_index + move] = new_state[zero_index + move], new_state[zero_index]
            
            if tuple(new_state) not in visited:
                new_path = path + [move]
                queue.append((new_state, new_path))
    
    return None

# Contoh penggunaan:
initial_statee = [8, 10, 12, 13, 30, 15, 25, 0, 20]
goal_statee = [8, 10, 12, 13, 15, 20, 25, 30, 0]

initial_state = [1, 2, 3, 4, 8, 5, 7, 0, 6]
goal_state = [1, 2, 3, 4, 5, 6, 7, 8, 0]
solution = bfs(initial_statee, goal_statee)

if solution:
    print("Solusi ditemukan dengan langkah-langkah:")
    for step, move in enumerate(solution):
        print(f"Langkah {step + 1}: Geser {move}")
else:
    print("Tidak ada solusi yang ditemukan.")
from mpi4py import MPI

def max_value(a, b):
    return a if a > b else b

def find_max(arr, start, end):
    if start > end:
        return -1  # Indikasi array kosong
    if start == end:
        return arr[start]  # Hanya satu elemen

    mid = (start + end) // 2
    max_left = find_max(arr, start, mid)
    max_right = find_max(arr, mid + 1, end)

    return max_value(max_left, max_right)

def main():
    comm = MPI.COMM_WORLD # Inisialisasi MPI
    rank = comm.Get_rank() # Mendapatkan nomor rank proses
    size = comm.Get_size() # Mendapatkan jumlah total proses

    arr = [12, 20, 13, 25, 8, 10, 15, 30]
    n = len(arr)

    local_start = rank * (n // size)
    local_end = (rank + 1) * (n // size) - 1

    local_max = find_max(arr, local_start, local_end)

    # Mengumpulkan nilai maksimum lokal dari semua proses ke proses root (biasanya rank 0)
    global_max = comm.reduce(local_max, op=MPI.MAX, root=0)

    if rank == 0:
        if global_max == -1:
            print("Array kosong.")
        else:
            print("Hasil maksimum dalam array menggunakan MPI:", global_max)

if __name__ == "__main__":
    main()

def find_max_serial(arr) :
    if len(arr) == 0 :
        return None
    
    max_val = arr[0]
    
    for num in arr :
        if num > max_val :
            max_val = num

    return max_val

# CONTOH
arr = [1, 65, 34, 2, 4, -9, 0]
print("Mencari Nilai Maks secara serial: ", find_max_serial(arr))
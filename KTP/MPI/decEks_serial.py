A = [12, 20, 13, 25, 8, 10, 15, 30, 0]

for i in range(len(A)):
    min_idx = i

    for j in range(i + 1, len(A)):
        if A[min_idx] > A[j]:
            min_idx = j
    A[i], A[min_idx] = A[min_idx], A[i]

zero_index = A.index(0)
A.pop(zero_index)
A.append(0)

print("Array terurut")
for i in range(len(A)):
    print("%d" % A[i], end=" , ")
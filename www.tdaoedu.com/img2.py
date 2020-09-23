# # -*- coding:UTF-8 -*-
import cv2
import numpy as np
#from PIL import Image


"""
背景替换成红色
:return:保存
"""
def replace_red(rows,cols,dilate,img):
    # 遍历替换
    for i in range(rows):
        for j in range(cols):
            if dilate[i, j] == 255:
                img[i, j] = (0, 0, 255)  # 此处替换颜色，为BGR通道
    cv2.imshow('res', img)
    cv2.imwrite('001.png', img, [int(cv2.IMWRITE_PNG_COMPRESSION), 0])

"""
背景替换成白色
:return:保存
"""
def replace_white(rows,cols,dilate,img):
    # 遍历替换
    for i in range(rows):
        for j in range(cols):
            if dilate[i, j] == 255:
                img[i, j] = (255, 255, 255)  # 此处替换颜色，为BGR通道
    cv2.imshow('res', img)
    cv2.imwrite('001.png', img, [int(cv2.IMWRITE_PNG_COMPRESSION), 0])

"""
背景替换成蓝色
:return:保存
"""
def replace_blue(rows,cols,dilate,img):
    # 遍历替换
    for i in range(rows):
        for j in range(cols):
            if dilate[i, j] == 255:
                img[i, j] = (255, 0, 0)  # 此处替换颜色，为BGR通道
    cv2.imshow('res', img)
    cv2.imwrite('00178.png', img, [int(cv2.IMWRITE_PNG_COMPRESSION), 0])



def main():
    flag = "red"
    img = cv2.imread('F:/h5/0921.png')
    # 缩放
    rows, cols, channels = img.shape
    scale_ratio = 0.5
    img = cv2.resize(img, None, fx=scale_ratio, fy=scale_ratio, interpolation=cv2.INTER_CUBIC)
    rows, cols, channels = img.shape
    cv2.imshow('img', img)

    # 转换hsv
    hsv = cv2.cvtColor(img, cv2.COLOR_BGR2HSV)
    lower_blue = np.array([90, 70, 70])
    upper_blue = np.array([110, 255, 255])
    mask = cv2.inRange(hsv, lower_blue, upper_blue)
    cv2.imshow('Mask', mask)

    # 腐蚀膨胀
    erode = cv2.erode(mask, None, iterations=1)
    cv2.imshow('erode', erode)
    dilate = cv2.dilate(erode, None, iterations=1)
    cv2.imshow('dilate', dilate)

    # 替换红色背景
    if flag == 'red':
        replace_red(rows,cols,dilate,img)
    elif flag == 'white':
        replace_white(rows,cols,dilate,img)
    elif flag == 'blue':
        replace_blue(rows,cols,dilate,img)
    cv2.waitKey(0)
    cv2.destroyAllWindows()






if __name__ == '__main__':
    main()